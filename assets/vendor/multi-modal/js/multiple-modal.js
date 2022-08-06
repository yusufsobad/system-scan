$('.modal').on('shown.bs.modal', function (e) {
    let $this = $(this),
        $parentModal = $this.parent().find($this.data('parent-modal') + '.modal');
    if ($parentModal.length) {
        $parentModal.modal('hide');
        $this.on('hidden.bs.modal', function (e) {
            $parentModal.modal('show');
        });
    }
});