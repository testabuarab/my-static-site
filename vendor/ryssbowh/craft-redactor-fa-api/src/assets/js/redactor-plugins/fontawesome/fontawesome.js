class FaGraphQl {
    constructor(version, license)
    {
        this.version = version;
        this.license = license;
    }

    search(name)
    {
        return new Promise((res, rej) => {
            this.query('search(version:"' + this.version + '",query:"' + name + '") {membership {free, pro},id,label}').then((data) => {
                let icons = [];
                for (let i in data.data.search) {
                    let styles = data.data.search[i].membership[this.license];
                    if (!styles.length) {
                        continue;
                    }
                    icons.push({
                        id: data.data.search[i].id,
                        label: data.data.search[i].label,
                        styles: styles
                    });
                }
                res(icons);
            }, (errors) => {
                rej(errors);
            });
        });
    }

    icons()
    {
        if (!this.iconList) {
            return new Promise((res, rej) => {
                this.release('icons(license: "' + this.license + '") {id,label,styles}').then((data) => {
                    res(data.data.release.icons);
                }, (errors) => {
                    rej(errors);
                });
            });
        }
        return new Promise((res, rej) => {
            res(this.iconList);
        });
    }

    release(fields)
    {
        return this.query('release(version:"' + this.version + '"){' + fields + '}');
    }

    query(command)
    {
        let data = {
            query: "query {" + command + "}"
        };
        return new Promise((res, rej) => {
            $.ajax({
                method: 'post',
                url: 'https://api.fontawesome.com',
                data: data,
                dataType: 'json'
            }).done((data) => {
                if (data.errors) {
                    return rej(data.errors);
                }
                res(data);
            });
        });
    }
}

!(function (i) {
    i.add("plugin", "fontawesome", {
        keyupTimeout: null,
        modal: null,
        form: null,
        majorVersion: null,
        styleToPrefixV5: {
            solid   : 'fas',
            regular : 'far',
            light   : 'fal',
            thin    : 'fat',
            duotone : 'fad',
            brands  : 'fab',
            kit     : 'fak'
        },
        translations: {en: 
            {
                title: Craft.t('redactor-fa-api', 'Font Awesome Icon'),
                search: Craft.t('redactor-fa-api', 'Enter an icon name'),
                cancel: Craft.t('redactor-fa-api', 'Cancel'),
                placeholderName: Craft.t('redactor-fa-api', 'Icon name or id'),
                placeholderClass: Craft.t('redactor-fa-api', 'Extra css class'),
                search: Craft.t('redactor-fa-api', 'Search'),
                loading: Craft.t('redactor-fa-api', 'Loading...'),
                apiError: Craft.t('redactor-fa-api', 'Couldn\'t fetch icons from the api')
            }
        },
        modals: {
            fontawesome: '<div class="redactor-fa-modal">\
            <form action="">\
                <input name="icon-name" placeholder="## placeholderName ##" autocomplete="off">\
                <input name="icon-class" placeholder="## placeholderClass ##">\
            </form>\
            <div class="result-list-wrapper">\
                <div class="loading">## loading ##</div>\
                <div class="errors"></div>\
                <div class="result-list"></div>\
            </div>\
            </div>'
        },
        init: function (i) {
            (this.app = i), (this.opts = i.opts), (this.lang = i.lang), (this.toolbar = i.toolbar), (this.insertion = i.insertion);
            if (i.opts.redactorFaApi.preventReplaceI) {
                delete i.opts.replaceTags.i;
            }
            if (this.opts.redactorFaApi.mode == 'path') {
                this._initPath();
            } else {
                this._initKit();
            }
        },
        _initPath() {
            this._initVersion(this.opts.redactorFaApi.version);
            this.graphQl = new FaGraphQl(this.opts.redactorFaApi.version, this.opts.redactorFaApi.license);
        },
        _initKit() {
            this._initVersion(window.FontAwesomeKitConfig.version);
            this.graphQl = new FaGraphQl(window.FontAwesomeKitConfig.version, window.FontAwesomeKitConfig.license);
        },
        _initVersion(version) {
            let elems = version.split('.')
            this.majorVersion = parseInt(elems[0]);
        },
        onmodal: {
            fontawesome: {
                opened: function($modal, $form)
                {
                    this.modal = $modal;
                    this.form = $form;
                    $form.getField('icon-name').focus();
                    $form.getField('icon-name').on('click', (e) => {
                        e.stopPropagation();
                    });
                    $form.getField('icon-name').on('focus', (e) => {
                        if (e.target.value) {
                            this._initSearch();
                            this._search();
                        }
                    });
                    $form.getField('icon-name').on('keyup', (e) => {
                        clearTimeout(this.keyupTimeout);
                        if (e.target.value) {
                            this._initSearch();
                            this.keyupTimeout = setTimeout(() => {
                                this._search();
                            }, 300);
                        } else {
                            this._closeList();
                        }
                    })
                    $form.on('submit', (e) => {
                        e.preventDefault();
                    });
                    document.addEventListener('click', () => {
                        this._closeList();
                    });
                }
            },
        },
        start: function () {
            var i = { title: this.lang.get("title"), api: "plugin.fontawesome.open" };
            this.toolbar.addButton("title", i).setIcon(`<i class="${ parseInt(this.opts.redactorFaApi.version) == 5 ? 'fab':'fa-solid'} fa-font-awesome"></i>`);
        },
        open: function () {
            var options = {
                title: this.lang.get('myplugin'),
                width: '600px',
                name: 'fontawesome',
                handle: 'fontawesome'
            };
            this.app.api('module.modal.build', options);
        },
        _search: function () {
            let name = this.form.getField('icon-name').val();
            if (!name) {
                return;
            }
            let errors = this.modal.nodes[0].querySelector('.errors');
            let loading = this.modal.nodes[0].querySelector('.loading');
            let list = this.modal.nodes[0].querySelector('.result-list');
            this.graphQl.search(name).then((data) => {
                this._buildResults(data, list);
                loading.style.display = 'none';
            }, () => {
                loading.style.display = 'none';
                this._showError(errors);
            });
        },
        _showError(errors) {
            errors.style.display = 'block';
            errors.innerHTML = this.lang.get('apiError');
        },
        _buildResults: function (icons, list) {
            icons.forEach((icon) => {
                icon.styles.forEach((style) => {
                    let faClass = this._faClass(style, icon);
                    let elem = document.createElement('div');
                    elem.classList.add('icon');
                    elem.innerHTML = '<i class="' + faClass + '"></i><label><span>' + icon.label + '</span><code>' + faClass + '</code></label>';
                    list.append(elem);
                    elem.addEventListener('click', () => {
                        this._insert(faClass);
                    })
                });
            });
        },
        _faClass(style, icon) {
            let extra = this.form.getField('icon-class').val();
            if (this.majorVersion == 5) {
                return this.styleToPrefixV5[style] + ' fa-' + icon.id + (extra ? ' ' + extra : '');
            }
            return 'fa-' + style + ' fa-' + icon.id + (extra ? ' ' + extra : '');
        },
        _initSearch()
        {
            this.modal.nodes[0].querySelector('.loading').style.display = 'block';
            this.modal.nodes[0].querySelector('.errors').style.display = 'none';
            this.modal.nodes[0].querySelector('.result-list').innerHTML = '';
            this.modal.nodes[0].querySelector('.result-list-wrapper').style.display = 'block';
        },
        _closeList()
        {
            this.modal.nodes[0].querySelector('.result-list-wrapper').style.display = 'none';
        },
        _insert(faClass)
        {
            this._closeList();
            this.app.api('module.modal.close');
            let classes = faClass.split(' ');
            let span = $R.dom('<span>');
            let icon = document.createElement('i');
            classes.forEach((ele) => {
                icon.classList.add(ele);
            })
            span.add(icon);
            this.insertion.insertNode(span, 'after');
        }
    });
})(Redactor);