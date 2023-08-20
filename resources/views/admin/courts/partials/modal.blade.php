<!-- Modal effects -->
<div class="modal" id="addCourt">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content modal-content-demo">
			<div class="modal-header">
				<h6 class="modal-title"></h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
			</div>
			<form class="form-horizontal" action="{{ route('admin.courts.store') }}" method="POST">
				@csrf
				<input type="hidden" name="_method">
                <input type="hidden" name="id">
				
				<div class="modal-body">
					<div class="form-group">
						<label for="court_name" class="label_name"></label>
						<input type="text" name="name" class="form-control" id="court_name">
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