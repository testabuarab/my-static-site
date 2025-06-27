tinymce.PluginManager.add('craftlink', function (editor) {

	const registerOption = editor.options.register;

	registerOption('link_class_list', {
        processor: 'object[]',
        default: []
    });

	registerOption('craftlink_adv_tab', {
        processor: 'boolean',
        default: false
    });

	registerOption('craftlink_data_attr', {
        processor: 'array',
        default: []
    });

	registerOption('craftlink_anker', {
        processor: 'boolean',
        default: false
    });

    editor.ui.registry.addMenuButton('craftlink', {
        text: translations.tinymce.linkLabel,
        icon: 'link',
		fetch: (callback) => {
			const items = [];

			for(let arguments of editor.options.linkOptions) {
				items.push ({
					type: "menuitem",
					text: arguments.optionTitle,
					onAction: ()=> {
						let refHandle = arguments.refHandle;
						let selectedText = "";

						let node = editor.selection.getNode();
						let a = editor.dom.getParent(node,"a[href]");

						if(a) {
							selectedText = $(a).html();
						} else {
							selectedText = editor.selection.getContent();
						}

						Craft.createElementSelectorModal(arguments.elementType, {
							storageKey: 'TinymceInput.LinkTo.' + arguments.elementType,
							sources: arguments.sources,
							criteria: arguments.criteria,
							defaultSiteId: editor.options.elementSiteId.id,
							autoFocusSearchBox: false,
							onSelect: (elements) => {
								if (elements.length) {
									const element = elements[0];
									
									if(!selectedText.length) {
										selectedText = element.label;
									}

									const dialogConfig = {
										title: translations.tinymce.link_insertEditLink,
										body: CraftLink.bodyDialog(refHandle,editor),
										initialData: {
											linkHref: element.url +
												'#' +
												refHandle +
												':' +
												element.id +
												'@' +
												element.siteId,

											text: selectedText,
											siteSelector: element.siteId+""
										},
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
											CraftLink.onChange(dialogApi,details);
										},
										onSubmit: (dialogApi) => {
											CraftLink.onSubmit(dialogApi);
										}
									};
									editor.windowManager.open(dialogConfig);
								}
							},
							closeOtherModals: false,
						});
					}
				});
			}

			items.push ({
				type: "menuitem",
				text: translations.tinymce.link_insertEditLink,
				onAction: (_)=> {
					const dialogConfig = {
						title: translations.tinymce.link_insertEditLink,
						body: CraftLink.bodyDialog("",editor),
						initialData: CraftLink.initialData(editor),
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
							CraftLink.onChange(dialogApi,details);
						},
						onSubmit: (dialogApi) => {
							CraftLink.onSubmit(dialogApi);
						}
					};
					editor.windowManager.open(dialogConfig);
				}
			});

			callback(items);
		  }
    });
});

const CraftLink = {
	bodyDialog: (refHandle, editor) => {
		let general_items = CraftLink.getBodyGeneralItems(refHandle,editor);

		let dialog_body = {};

		if(editor.options.get('craftlink_adv_tab')) {
			let advanced_items = CraftLink.getBodyAdvancedItems(editor);

			dialog_body.type = "tabpanel";
			dialog_body.tabs = [];
			dialog_body.tabs.push({
				name: "general",
				title: "General",
				items: general_items
			});
			dialog_body.tabs.push({
				name: "advanced",
				title: "Advanced",
				items: advanced_items
			});

		} else {
			dialog_body.type = "panel";
			dialog_body.items = general_items;
		}

		return dialog_body;
	},

	initialData: (editor) => {
		let node = editor.selection.getNode();
		let a = editor.dom.getParent(node,"a[href]");

		let initialData = {};
		initialData.linkHref = "";
		initialData.text = "";
		initialData.title = "";
		initialData.target = "";
		initialData.linkClass = "";
		initialData.siteSelector = "";
		initialData.linkId = "";
		initialData.additionalClasses = "";

		if(isNonNullable(a)) {
			let allClasses = $(a).prop("class").split(" ");
			let additionalClasses = "";

			let linkHref = getAttrib(a,"href").replace(/:url$/,"");
			
			if(editor.options.get('craftlink_anker')) {
				const pcs = linkHref.match(/^(.*?)(#(?!(entry|category|product|asset)\:[0-9]+).*?)?(#(entry|category|product|asset)\:[0-9]+.*)?$/i);
				
				if (pcs && pcs.length > 2 && pcs[2] !== undefined) {
					linkHref = pcs[1] + (pcs[4] !== undefined ? pcs[4] : '');
					initialData.anchor = pcs[2].replace('#', '');
				}
			}

			initialData.linkHref = linkHref;
			initialData.text = $(a).html();
			initialData.title = $(a).prop("title");
			initialData.target = $(a).prop("target");

			if(editor.options.get('link_class_list').length) {

				const link_class_list = editor.options.get('link_class_list');

				for(let x=0; x < allClasses.length; x++) {
					let found_link_class = false;
					for (let i=0; i < link_class_list.length; i++) {

						if(allClasses[x]===link_class_list[i].value) {
							initialData.linkClass = allClasses[x];
							found_link_class = true;
						}
					}
					if(!found_link_class) {
						additionalClasses += allClasses[x];
					}
				}
			}

			if(initialData.linkHref.match(/#(category|entry|product):\d+/)) {
				let selectedSite = 0;
				if (initialData.linkHref.split('@').length > 1) {
					selectedSite = parseInt(initialData.linkHref.split('@').pop(), 10);
				}
				initialData.siteSelector = selectedSite+"";
			}

			initialData.linkId = $(a).prop("id");
			initialData.additionalClasses = additionalClasses.trim();

			const initialDataAttributes = a.dataset;

			Object.entries(initialDataAttributes).forEach(([key, value]) => {
				if(!key.startsWith("mce")) {
					initialData["data_"+key] = value;
				}
			});
		}

		return initialData;
	},

	onSubmit: (dialogApi) => {
		const data = dialogApi.getData();
		const editor = tinymce.activeEditor;

		if(isNonNullable(data.text) && data.text === "") {
			alert("text is required");
			return;
		}

		let node = editor.selection.getNode();

		let a = editor.dom.getParent(node,"a[href]");
		
		let content = editor.selection.getContent();

		let classes = data.linkClass;

		if(data.hasOwnProperty("additionalClasses") && data.additionalClasses.length) {
			classes += " "+data.additionalClasses.trim();
		}

		let allowed_data_attributes_for_craftlink = [];
		if(editor.options.get('craftlink_adv_tab') && editor.options.get('craftlink_data_attr').length) {
			allowed_data_attributes_for_craftlink = editor.options.get('craftlink_data_attr');
		}

		let newHref = data.linkHref;

		if(!isNullable(data.anchor) && editor.options.get('craftlink_anker')) {
			let newanchor = data.anchor.replace("#","").trim();
			if(newanchor.length) {
				newanchor = "#" + newanchor;
			}

			const i = newHref.indexOf("#");

            if (i >= 0) {
                newHref = newHref.slice(0, i) + newanchor + newHref.slice(i);
            } else {
                newHref += newanchor;
            }

            newHref = newHref.replace(/#$/, '');
		}

		let insert_a_tag = false;
		if(isNullable(a)) {
			insert_a_tag = true;
			a = document.createElement('a');

			if(isNonNullable(data.text)) {
				a.innerHTML = data.text;
			} else {
				a.innerHTML = content;
			}
		}
		
		a.href = newHref;
		rawSet(a,"data-mce-href",newHref);

		rawSet(a,"target",data.target);
		
		if(data.title) {
			rawSet(a,"title",data.title);
		}
		if(classes==="") {
			a.removeAttribute("class");
		} else {
			rawSet(a,"class",classes);
		}
		if(data.hasOwnProperty("linkId")) {
			if(data.linkId.length) {
				rawSet(a,"id",data.linkId);
			} else {
				a.removeAttribute("id");
			}
		}

		if(editor.options.get('craftlink_adv_tab')) {

			const initialDataAttributes = a.dataset;
			Object.entries(initialDataAttributes).forEach(([key, value]) => {
				if(!key.startsWith("mce")) {
					delete a.dataset[key];
				}
			});

			for (let i=0; i < allowed_data_attributes_for_craftlink.length; i++) {

				if(data.hasOwnProperty("data_"+allowed_data_attributes_for_craftlink[i])) {

					if(data["data_"+allowed_data_attributes_for_craftlink[i]]!=="") {
						a.dataset[allowed_data_attributes_for_craftlink[i]] = data["data_"+allowed_data_attributes_for_craftlink[i]];
					}
				}
			}
		}

		if(insert_a_tag) {
			editor.insertContent(a.outerHTML);
		}
		dialogApi.close();
	},

	onChange: (dialogApi,details) => {
		if(details.name==="siteSelector") {
			let data = dialogApi.getData();

			let existingUrl = data.linkHref;
			const selectedSiteId = parseInt(data.siteSelector, 10);

			if (existingUrl.match(/.*(@\d+)$/)) {
				let urlParts = existingUrl.split('@');
				urlParts.pop();
				existingUrl = urlParts.join('@');
			}

			if (selectedSiteId) {
				existingUrl += '@' + selectedSiteId;
			}

			dialogApi.setData({linkHref: existingUrl});
		}
	},

	getBodyGeneralItems: (refHandle, editor) => {
		let general_items = [
			{
				type: "input",
				name: "linkHref",
				inputmode: "text",
				label: "URL"
			}
		];

		let node = editor.selection.getNode();
		let a = editor.dom.getParent(node,"a[href]");

		if(isNullable(a) && (editor.selection.getContent()===null || editor.selection.getContent().length===0)) {
			
			general_items.push({type: "htmlpanel",html: "<div>&nbsp;</div>"});
			general_items.push({
				type: "input",
				name: "text",
				inputmode: "text",
				label: "Text to display",
				required: true
			});
		}

		general_items.push({type: "htmlpanel",html: "<div>&nbsp;</div>"});
		general_items.push({
			type: "input",
			name: "title",
			inputmode: "text",
			label: "Title"
		});

		general_items.push({type: "htmlpanel",html: "<div>&nbsp;</div>"});
		general_items.push({
			type: "listbox",
			name: "target",
			label: translations.tinymce.link_targetLabel,
			items: [
				{ text: "Current Window", value: "" },
				{ text: "New Window", value: "_blank" }
			]
		});

		if(editor.options.get('link_class_list').length) {
			const link_class_list = editor.options.get('link_class_list');

			let linkClassListBox = {
				type: "listbox",
				name: "linkClass",
				label: translations.tinymce.link_class,
				items: []
			};

			for (let i=0; i < link_class_list.length; i++) {
				linkClassListBox.items.push({text: link_class_list[i].title, value: link_class_list[i].value});
			}

			general_items.push({type: "htmlpanel",html: "<div>&nbsp;</div>"});
			general_items.push(linkClassListBox);
		}

		let elementUrl = "";

		let is_entry_link = false;
		if(refHandle.match(/^(category|entry|product)$/)) {
			is_entry_link = true;

		} else if(a) {
			elementUrl = $(a).prop("href");

			if (elementUrl.match(/#(category|entry|product):\d+/)) {
				is_entry_link = true;
			}
		}
		
		if(editor.options.get('craftlink_anker')) {
			general_items.push({type: "htmlpanel",html: "<div>&nbsp;</div>"});
			general_items.push({
				type: "input",
				name: "anchor",
				inputmode: "text",
				label: "Anchor"
			});
		}

		// Only add site selector if it looks like an element reference link
        if (is_entry_link) {

			let siteOptions = editor.options.allSites;

			let siteListBox = {
				type: "listbox",
				name: "siteSelector",
				label: translations.tinymce.link_site,
				items: [
					{ text: "Multisite", value: "0" },
				]
			};

			for ([siteId, siteName] of Object.entries(siteOptions)) {
				siteListBox.items.push({text: siteName, value: siteId});
			}

			general_items.push({type: "htmlpanel",html: "<div>&nbsp;</div>"});
			general_items.push(siteListBox);
		}

		return general_items;
	},

	getBodyAdvancedItems: (editor) => {
		let advanced_items = [
			{
				type: "input",
				name: "linkId",
				inputmode: "text",
				label: "ID"
			},
			{ type: "htmlpanel", html: "<div>&nbsp;</div>" },
			{
				type: "input",
				name: "additionalClasses",
				inputmode: "text",
				label: translations.tinymce.link_additionalClasses
			}
		];

		if(editor.options.get('craftlink_data_attr').length) {
			
			const allowed_data_attributes_for_craftlink = editor.options.get('craftlink_data_attr');

			advanced_items.push({ type: "htmlpanel", html: "<div>&nbsp;</div>" });

			for (let i=0; i < allowed_data_attributes_for_craftlink.length; i++) {
				advanced_items.push({
					type: "input",
					name: "data_"+allowed_data_attributes_for_craftlink[i],
					inputmode: "text",
					label: "data-"+allowed_data_attributes_for_craftlink[i]
				});
			}
		}

		return advanced_items;
	},
};