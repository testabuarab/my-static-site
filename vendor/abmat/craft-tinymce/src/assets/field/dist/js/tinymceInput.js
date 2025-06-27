const bodyNode = document.getElementsByTagName("body")[0];
const tinymceCallback = (mutationList,observer) => {
	for (const mutation of mutationList) {
    	if (mutation.type === "childList") {
			if(mutation.addedNodes.length) {
				
				mutation.addedNodes.forEach((node) => {

					if(node.classList) {

						const $tinymceObjects = $(node).find("textarea.tinymce[name!='']");
					
						if($tinymceObjects.length) {
							
							$tinymceObjects.each((index, $tinymce_element) => {
								let tinymce_obj = tinymce.get($tinymce_element.id);
								
								if(tinymce_obj) {
									tinymce_obj.save();
									tinymce_obj.dispatch("refresh", {fieldid: $tinymce_element.id});
								}
							});
						}
					}
				});
			}
		}
	}
};
const tinymceObserverConfig = { attributes: false, childList: true, subtree: true };
const tinymceObserver = new MutationObserver(tinymceCallback);
tinymceObserver.observe(bodyNode, tinymceObserverConfig);

Garnish.on(Craft.Preview, 'beforeOpen beforeClose', () => {
	tinymceObserver.disconnect();
});

Garnish.on(Craft.Preview, "open close", () => {
	tinymceObserver.observe(bodyNode, tinymceObserverConfig);
});

Craft.TinymceInput = Garnish.Base.extend({
	id: null,
	linkOptions: null,
	volumes: null,
	elementSiteId: null,
	allSites: {},
	tinymceConfig: null,
	showAllUploaders: false,
	editor: null,
	defaultTransform: null,

	$textarea: null,

	init: function(settings) {
		
		this.id = settings.id;
		this.linkOptions = settings.linkOptions;
		this.volumes = settings.volumes;
		this.transforms = settings.transforms;
		this.elementSiteId = settings.elementSiteId;
		this.allSites = settings.allSites;
		this.tinymceConfig = settings.tinymceConfig;
		this.showAllUploaders = settings.showAllUploaders;
		this.defaultTransform = settings.defaultTransform;

		this._initTinymce();

		Garnish.on(Craft.Preview, 'open close', () => {
			let tinymce_obj = tinymce.get(this.id);

			if(tinymce_obj) {
				tinymce_obj.save();
				tinymce_obj.dispatch("refresh", {fieldid: this.id});
			}
		});
	},

	_initTinymce: function () {
		var selector = "#"+this.id;
		this.$textarea = $(selector);

		this.tinymceConfig.selector = selector;

		this.tinymceConfig.setup = (editor) => {
			this.editor = editor;

			editor.options.linkOptions = this.linkOptions;
			editor.options.volumes = this.volumes;
			editor.options.transforms = this.transforms;
			editor.options.elementSiteId = this.elementSiteId;
			editor.options.allSites = this.allSites;

			editor.addShortcut("meta+s","",() => {
				editor.save();
				Garnish.uiLayerManager.triggerShortcut(new KeyboardEvent('keydown', {
					shiftKey: false,
					metaKey: true,
					ctrlKey: true,
					altKey: false,
					keyCode: Garnish.S_KEY
				}));
			});
			editor.addShortcut("meta+shift+s","",() => {
				editor.save();
				Garnish.uiLayerManager.triggerShortcut(new KeyboardEvent('keydown', {
					shiftKey: true,
					metaKey: true,
					ctrlKey: true,
					altKey: false,
					keyCode: Garnish.S_KEY
				}));
			});
			editor.on("focusout",(e) => {
				if(e.target !== null && e.target !== undefined) {
					let originalEditor = tinymce.get(e.target.dataset.id);
					if(originalEditor.isNotDirty === false) {
						originalEditor.save();
					}
				}
			});
			editor.on("refresh", (e) => {
				tinymce.remove("#" + e.fieldid);
				tinymce.init(this.tinymceConfig);
			});
		}
		this.tinymceConfig.urlconverter_callback = (url, node, on_save, name) => {
			// Return new URL
			return url;
		};
		
		tinymce.init(this.tinymceConfig);
	},
});