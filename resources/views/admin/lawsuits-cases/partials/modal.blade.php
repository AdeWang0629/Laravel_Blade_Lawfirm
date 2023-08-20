<!-- Modal effects -->
<div class="modal" id="lawsuitCase">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title"></h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form class="form-horizontal" action="#" method="POST">
                @csrf
                <input type="hidden" name="_method">
                <input type="hidden" name="id">

                <div class="modal-body">							
                    <div class="form-group">
                        <div class="row row-sm">
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="name" class="label_name">{{ trans_choice('site.status', 0) .' '. trans_choice('site.lawsuites', 0) }}</label>
                                <input type="text" name="name" class="form-control" id="lawsuite_case">
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="colorpicker" class="label_name">{{ trans('site.color') }}</label>
                                <input type="text" class="colorpicker" id="colorpicker" name="color">
                            </div>
                        </div>
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