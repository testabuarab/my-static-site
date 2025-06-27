var settings =
{
    init()
    {
        this.lightswitch = $('#settings-fa-usekit');
        this.kitFields = $('#settings-mode-kit-fields');
        this.pathFields = $('#settings-mode-path-fields');
        this.initLightswitch();
    },

    initLightswitch()
    {
        this.lightswitch.on('change', () => {
            if (this.lightswitch.hasClass('on')) {
                this.kitFields.removeClass('hidden');
                this.pathFields.addClass('hidden');
            } else {
                this.kitFields.addClass('hidden');
                this.pathFields.removeClass('hidden');
            }
        });
    }
};

settings.init();