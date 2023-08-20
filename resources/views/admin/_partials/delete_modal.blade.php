<!-- Modal effects -->
<div class="modal" id="deleteItemModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title"></h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form class="form-horizontal" action="#" method="POST">
                @csrf
                @method('DELETE')

				<input type="hidden" name="id">
                <div class="modal-body">							
                    <label class="delete_label mb-0"></label>
                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-danger save-btn" type="submit">{{ trans('site.delete') }}</button>
                    <button class="btn ripple btn-secondary close-btn" data-dismiss="modal" type="button">{{ trans('site.cancel') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal effects-->