/* Styled List Plugin (by Dan Brellis)
 * This plugin adds font awesome icons as list markers
*/

(function($R)
{

  $R.add('plugin', 'falist', {
    translations: {
      en: {
        "fa-list": "Icon List"
      }
    },
    modals: {
      // this is variable with modal HTML body
      'faIcons': '<section class="redactorFaList">'
        + '<div class="iconFilterInput"><input placeholder="' + Craft.t('redactor-font-awesome', 'Search for icons') + '" class="iconSearchBox" type="text" /></div>'
        + '<form action="">'
        + '<div><label class="iconList__selectable">Clear Font Awesome Icon List <input type="radio" name="icon" value="clearFaList" /></label></div>'
        + '<div class="iconList"></div>'
        + '</section>'
    },
    init: function(app) {
      // define app
      this.app = app;

      // define toolbar so we can add the button to it
      this.toolbar = app.toolbar;

      // define lang service
      this.lang = app.lang;

      // define services
      this.selection = app.selection;
    },
    start: function() {
      // create the button data
      const buttonData = {
        title: this.lang.get('fa-list'),
        api: 'plugin.falist.open'
      };

      // create the actual button
      const $button = this.toolbar.addButtonAfter('lists', 'falist', buttonData);
      $button.setIcon('<i class="fa-icon-lists re-icon-custom"></i>');
    },
    open: function(){
      const options = {
        title: 'Font Awesome Icons', // the modal title
        name: 'faIcons', // the modal variable in modals object
        height: '450px',
        width: '700px',
        commands: {
          insert: {title: 'Insert'},
          cancel: {title: 'Cancel'}
        }
      };

      // open the modal with API
      this.app.api('module.modal.build', options);
    },
    onmodal: {
      faIcons: {
        open: function ($modal, $form) {
          const iconTypeMap = {
            fas: "solid",
            far: "regular",
            fal: "light",
            fad: "duotone",
            fab: "brand"
          };
          const prefix = $modal.nodes[0].parentNode.id;
          const blkstr = [];
          let icon, label, iconName, iconType;
          for (let i = 0; i < FAListIcons.length; i++) {
            icon = FAListIcons[i];
            if(typeof icon === "string") {
              iconName = icon;
              iconType = "fas";
            }
            else if(typeof icon === "object") {
              iconName = Object.keys(icon)[0];
              iconType = icon[iconName];
            }
            label = prefix + '-' + iconType + '-' + iconName;
            blkstr.push(
              '<div class="iconList__selectableCont">' +
              '<input class="iconList__input" type="radio" id="' + label + '" name="icon" value="' + iconType + ' fa-' + iconName +'" />' +
              '<label class="iconList__selectable iconList__label" for="' + label + '">' +
              '<i class="iconList__icon ' + iconType + ' fa-' + iconName + '"></i>' +
              '<span class="iconList__iconName">' + iconName + ' (' + iconTypeMap[iconType] + ')</span>' +
              '</label>' +
              '</div>');
          }

          $modal.find(".iconList").html(blkstr.join(""));

          this.app.selection.save();

          // Filter icons
          $('#' + prefix + ' .iconSearchBox').keyup(function () {
            let valThis = $(this).val().toLowerCase();
            $('#' + prefix + ' .iconList .iconList__iconName').each(function () {
              let text = $(this).text().toLowerCase();
              (text.indexOf(valThis) == 0) ? $(this).parent().parent().show() : $(this).parent().parent().hide();
            });
          });
          // End filter icons
        },
        insert: function ($modal, $form) {
          const form = $form.nodes[0];
          const selectedIcon = form.querySelector('input[name="icon"]:checked').value;

          this.app.api('module.modal.close');
          this.app.selection.restore();

          if(selectedIcon === "clearFaList"){
            this.unStyle();
          }
          else {
            const iconHTML = '<span class="fa-li"><i class="' + selectedIcon + '"></i></span>';
            this.toggle(iconHTML);
          }
        }
      }
    },
    unStyle: function(){
      const block = this.selection.getBlock();
      if (!block) return;

      const parent = block.parentNode;
      const $parent = $R.dom(parent);
      $parent.removeClass("fa-ul");

      const spans = $parent.find('.fa-li');
      $R.dom(spans).remove();
    },
    toggle: function(icon) {
      // Get the first block element containing the selection
      // We're getting the block so we ignore inline elements like <strong>
      let block = this.selection.getBlock();
      if (!block) return;

      // Get the parent of that element and figure out what it is.\
      let parent = block.parentNode;
      let parentNodeName = parent.nodeName;

      //this.unStyle(parent);

      // If it isn't a list at all, make it one and update the parent.
      if (!["UL", "OL"].includes(parentNodeName)) {
        this.app.api('module.list.toggle', 'ul');
        block = this.selection.getBlock();
        parent = block.parentNode;
      }

      const $parent = $R.dom(parent);

      //if it's already an FA list, only change the selected <li> icon
      if(parent.classList.contains("fa-ul")){
        let blocks = this.selection.getBlocks();
        blocks.forEach((b) => {
          if(b.nodeName === "LI"){
            let $block = $R.dom(b);
            let span = $block.find('.fa-li');
            $R.dom(span).remove();
            this.addIconMarker(b, icon);
          }
        });
      }
      else {
        //otherwise, make it an FA list, and add the selected icon to all <li>
        $parent.addClass("fa-ul");
        let blocks = $parent.children("li");
        blocks.nodes.forEach((block) => this.addIconMarker(block, icon));
      }

      return parent;
    },
    addIconMarker(block, icon){
      if(block.nodeName === "LI"){
        //add icon and wrapper to li
        let $li = $R.dom(block);
        $li.prepend(icon);
      }
    }
  });
})(Redactor);