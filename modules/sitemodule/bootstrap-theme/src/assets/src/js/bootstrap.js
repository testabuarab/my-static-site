window.Popovers = {
    init: function () {
        var _this = this;
        let list = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
        list.map(function (elem) {
            return _this.initPopover(elem);
        });
    },

    initPopover: function (elem, options) {
        new bootstrap.Popover(elem, options);
    }
};

window.Tooltips = {
    init: function () {
        var _this = this;
        let list = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        list.map(function (elem) {
            return _this.initTooltip(elem);
        });
    },

    initTooltip: function (elem) {
        new bootstrap.Tooltip(elem);
    }
};

document.addEventListener('DOMContentLoaded', function(){ 
    window.Popovers.init();
    window.Tooltips.init();
});