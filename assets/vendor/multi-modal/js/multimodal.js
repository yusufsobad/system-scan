(function ($, window) {
    var MultiModal = function (element) {
        this.$element = $(element);
        this.modalCount = 0;
    };

    MultiModal.BASE_ZINDEX = 1040;

    MultiModal.prototype.show = function (target) {
        var that = this;
        var $target = $(target);

        // Bootstrap triggers the show event at the beginning of the show function and before
        // the modal backdrop element has been created. The timeout here allows the modal
        // show function to complete, after which the modal backdrop will have been created
        // and appended to the DOM.
        window.setTimeout(function () {
            that.modalCount = getModalCount();

            // we only want one backdrop; hide any extras
            if (that.modalCount > 1)
                $('.modal-backdrop').not(':first').addClass('hidden');

            that.adjustModal($target);
            that.adjustBackdrop();
        });
    };

    MultiModal.prototype.hidden = function (target) {
        this.modalCount = getModalCount();

        if (this.modalCount) {
            this.adjustBackdrop();

            // bootstrap removes the modal-open class when a modal is closed; add it back
            $('body').addClass('modal-open');
        }
    };

    function getModalCount() {
        return $('.modal:visible').length;
    }

    MultiModal.prototype.adjustModal = function ($target) {
        var modalIndex = this.modalCount - 1;
        $target.css('z-index', MultiModal.BASE_ZINDEX + (modalIndex * 20) + 10);
    };

    MultiModal.prototype.adjustBackdrop = function () {
        var modalIndex = this.modalCount - 1;
        $('.modal-backdrop:first').css('z-index', MultiModal.BASE_ZINDEX + (modalIndex * 20));
    };

    function Plugin(method, target) {
        return this.each(function () {
            var $this = $(this);
            var data = $this.data('multi-modal-plugin');

            if (!data)
                $this.data('multi-modal-plugin', (data = new MultiModal(this)));

            if (method)
                data[method](target);
        });
    }

    $.fn.multiModal = Plugin;
    $.fn.multiModal.Constructor = MultiModal;

    $(document).on('show.bs.modal', '.modal', function () {
        const zIndex = 10 +
            Math.max(...Array.from(document.querySelectorAll('*')).map((el) => +el.style.zIndex));
        $(this).css('z-index', zIndex);
        setTimeout(() => $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack'));
    });

    $(document).on('hidden.bs.modal', '.modal',
        () => $('.modal:visible').length && $(document.body).addClass('modal-open'));
}(jQuery, window));
