tinymce.PluginManager.add('craftimage', function (editor) {

  const registerOption = editor.options.register;

  registerOption('craftimage_class_list', {
    processor: 'object[]',
    default: []
  });

  registerOption('craftimage_title', {
    processor: 'boolean',
    default: false
  });

	editor.ui.registry.addToggleButton('craftimage', {
    text: '',
    icon: 'image',
		tooltip: translations.tinymce.image_insertEditImage,
		onAction: (_) => {

      const dialogConfig = {
        title: translations.tinymce.image_editImage,
        body: CraftImage.bodyDialog(editor),
        initialData: CraftImage.initialData(editor),
        buttons: [
          {
            type: 'cancel',
            name: 'closeButton',
            text: 'Cancel'
          },
          {
            type: 'submit',
            name: 'submitButton',
            text: 'Save',
            buttonType: 'primary'
          }
        ],
        onChange: (dialogApi,details) => {
          CraftImage.onChange(dialogApi,details);
        },
        onSubmit: (dialogApi) => {
          CraftImage.onSubmit(dialogApi);
        }
      };

      const selectedImage = CraftImage.getSelectedImage(editor);

      if(selectedImage===null) {

        const criteria = {
          siteId: CraftImage.elementSiteId,
          kind: 'image',
        };

        const modal = Craft.createElementSelectorModal('craft\\elements\\Asset',{
          storageKey: 'RedactorInput.ChooseImage',
          multiSelect: false,
          sources: editor.options.volumes,
          criteria: criteria,
          onSelect: (assets, transform) => {
            const image = document.createElement('img');
            rawSet(image, "src", assets[0].url+"#asset:"+assets[0].id);
            editor.insertContent(image.outerHTML);
          }
        });

      } else {
        editor.windowManager.open(dialogConfig);
      }
		},
    onSetup: buttonApi => {
      buttonApi.setActive(isNonNullable(CraftImage.getSelectedImage(editor)));
      return editor.selection.selectorChangedWithUnbind('img:not([data-mce-object]):not([data-mce-placeholder])', buttonApi.setActive).unbind;
    }
  });
});

const CraftImage = {
  bodyDialog: (editor) => {
    let dialog_body = {};

    dialog_body.type = "panel";
		dialog_body.items = [
      {
				type: "input",
				name: "image_alt",
				inputmode: "text",
				label: translations.tinymce.image_alternateText
			}
    ];

    if(editor.options.get('craftimage_title')) {
      dialog_body.items.push({type: "htmlpanel",html: "<div>&nbsp;</div>"});

      dialog_body.items.push({
        type: "input",
        name: "title",
        inputmode: "text",
        label: translations.tinymce.image_title
      });
    }

    if(editor.options.get('craftimage_class_list').length) {
			const image_class_list = editor.options.get('craftimage_class_list');

			let imageClassListBox = {
				type: "listbox",
				name: "image_class",
				label: translations.tinymce.image_class,
				items: []
			};

			for (let i=0; i < image_class_list.length; i++) {
				imageClassListBox.items.push({text: image_class_list[i].title, value: image_class_list[i].value});
			}

			dialog_body.items.push({type: "htmlpanel",html: "<div>&nbsp;</div>"});
			dialog_body.items.push(imageClassListBox);
		}

    dialog_body.items.push({type: "htmlpanel",html: "<div>&nbsp;</div>"});
    dialog_body.items.push({
      type: 'grid',
      columns: 2,
      items: [
        {
          type: "input",
          name: "width",
          inputmode: "text",
          label: translations.tinymce.image_width
        },
        {
          type: "input",
          name: "height",
          inputmode: "text",
          label: translations.tinymce.image_height
        }
      ]
    });

    dialog_body.items.push({type: "htmlpanel",html: "<div>&nbsp;</div>"});
		dialog_body.items.push({
      type: "listbox",
      name: "image_loading",
      label: translations.tinymce.image_loading,
      items: [
        {text: 'auto', value: ''},
        {text: 'eager', value: 'eager'},
        {text: 'lazy', value: 'lazy'}
      ]
    });

    if(editor.options.transforms.length) {
      const imgElm = CraftImage.getSelectedImage(editor);

      if(imgElm !== null) {
        const elementUrl = getAttrib(imgElm,"src");
        if (elementUrl.match(/#(asset):\d+/)) {

          let transformItem = {
            type: "listbox",
            name: "transform",
            label: translations.tinymce.image_transform,
            items: [{
              text: 'None',
              value: ''
            }]
          }

          for(let item of editor.options.transforms) {
            transformItem.items.push({
              text: item.name,
              value: item.handle
            });
          }

          dialog_body.items.push({type: "htmlpanel",html: "<div>&nbsp;</div>"});
          dialog_body.items.push(transformItem);
        }
      }
    }
    
    return dialog_body;
  },

  initialData: (editor) => {
    let initialData = {};

    const imgElm = CraftImage.getSelectedImage(editor);

    if(imgElm!==null) {
      initialData["image_alt"] = getAttrib(imgElm,"alt");
      initialData["title"] = getAttrib(imgElm,"title");
      initialData["image_class"] = getAttrib(imgElm,"class");
      initialData["width"] = getAttrib(imgElm,"width");
      initialData["height"] = getAttrib(imgElm,"height");
      initialData["image_loading"] = getAttrib(imgElm,"loading");

      let transform_matches = getAttrib(imgElm,"src").match(/:transform:(\w+)/);
      if(transform_matches !== null && transform_matches.length == 2) {
        initialData["transform"] = transform_matches[1];
      }
    }

    return initialData;
  },

  getSelectedImage: (editor) => {
    const imgElm = editor.selection.getNode();
    const figureElm = editor.dom.getParent(imgElm, 'figure.image');
    if (figureElm) {
      return editor.dom.select('img', figureElm)[0];
    }
    if (imgElm && (imgElm.nodeName !== 'IMG' || CraftImage.isPlaceholderImage(imgElm))) {
      return null;
    }
    return imgElm;
  },

  isPlaceholderImage: (imgElm) => imgElm.nodeName === 'IMG' && (imgElm.hasAttribute('data-mce-object') || imgElm.hasAttribute('data-mce-placeholder')),

  getAssetUrlComponents: (url) => {
    const matches = url.match(
      /(.*)#asset:(\d+):(url|transform):?([a-zA-Z][a-zA-Z0-9_]*)?/
    );
    return matches
      ? {
          url: matches[1],
          assetId: matches[2],
          transform: matches[3] !== 'url' ? matches[4] : null,
        }
      : null;
  },

  getTransformUrl: (assetId, handle, callback) => {
    var data = {
      assetId: assetId,
      handle: handle,
    };

    Craft.sendActionRequest('POST', 'assets/generate-transform', {data})
      .then((response) => {
        const url = response.data && response.data.url;
        if (url) {
          callback(url);
        }
      })
      .catch(({response}) => {
        alert('There was an error generating the transform URL.');
      });
  },

  buildAssetUrl: (assetId, assetUrl, transform) => {
      return assetUrl +
      '#asset:' +
      assetId +
      ':' +
      (transform ? 'transform:' + transform : 'url');
  },

  removeTransformFromUrl: (url) => {
    return url.replace(/(.*)(_[a-z0-9+].*\/)(.*)/, '$1$3');
  },

  onSubmit: (dialogApi) => {
    const data = dialogApi.getData();
    const editor = tinymce.activeEditor;

    let imgElm = CraftImage.getSelectedImage(editor);

    if(data.image_alt.length) {
      rawSet(imgElm,"alt",data.image_alt);
    } else {
      imgElm.removeAttribute("alt");
    }
    if(data.title.length) {
      rawSet(imgElm,"title",data.title);
    } else {
      imgElm.removeAttribute("title");
    }
    if(data.image_class.length) {
      rawSet(imgElm,"class",data.image_class);
    } else {
      imgElm.removeAttribute("class");
    }    
    if(data.width.length && data.width!=="0") {
      rawSet(imgElm,"width",data.width);
    } else {
      imgElm.removeAttribute("width");
    }
    if(data.height.length && data.height!=="0") {
      rawSet(imgElm,"height",data.height);
    } else {
      imgElm.removeAttribute("height");
    }
    if(data.image_loading.length) {
      rawSet(imgElm,"loading",data.image_loading);
    } else {
      imgElm.removeAttribute("loading");
    }

    dialogApi.close();
  },

  onChange: (dialogApi,details) => {
    if(details.name==="transform") {
      const editor = tinymce.activeEditor;
      let imgElm = CraftImage.getSelectedImage(editor);

      if(imgElm!==null) {

        let data = dialogApi.getData();
        let urlComp = CraftImage.getAssetUrlComponents(imgElm.src);

        if(data.transform!=="") {
          CraftImage.getTransformUrl(urlComp.assetId,data.transform, function(url) {
            let image_src = CraftImage.buildAssetUrl(urlComp.assetId, url, data.transform);
            imgElm.src = image_src;
            rawSet(imgElm,"data-mce-src",image_src);
          });
        } else {
          urlComp.url = CraftImage.removeTransformFromUrl(urlComp.url);
          let image_src = CraftImage.buildAssetUrl(urlComp.assetId, urlComp.url, "");
          imgElm.src = image_src;
          rawSet(imgElm,"data-mce-src",image_src);
        }
      }
    }
  },
}