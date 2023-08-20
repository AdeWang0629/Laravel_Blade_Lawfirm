<!-- Modal effects -->
<div class="modal" id="addDocuments">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title"></h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form class="form-horizontal" action="#" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-0">
                        <input type="hidden" name="lawsuite_id">
                        <input type="file" name="lawsuite_documents[]" id="lawsuite_documents" class="form-control" multiple="multiple">
                        <span class="form-text text-muted">{{ trans('site.file_size_should_be_less_than_attr_mega', ['attr' => '2']) }}</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-primary save-btn" type="submit">{{ trans('site.add') }}</button>
                    <button class="btn ripple btn-secondary close-btn" data-dismiss="modal" type="button">{{ trans('site.cancel') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal effects-->