<!-- Modal effects -->
	<div class="modal" id="lawsuiteNumber">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content modal-content-demo">
				<div class="modal-header">
					<h6 class="modal-title"></h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
				</div>
				<form class="form-horizontal" action="#" method="POST">
					@csrf
					<input type="hidden" name="_method">
					<input type="hidden" name="id">
					<input type="hidden" name="lawsuite_id">
					<div class="modal-body">
						<div class="form-group">
							<div class="row row-sm">
								<div class="col-lg mg-t-10 mg-lg-t-0">
									<label for="description"><span class="font-weight-bold">{{ trans('site.description') }}</span></label>
									<input type="text" name="description" id="description" class="form-control" autofocus>
								</div>
								<div class="col-lg mg-t-10 mg-lg-t-0">
									<label for="number"><span class="font-weight-bold">{{ trans_choice('site.numbers', 0) }}</span></label>
									<input type="text" name="number" id="number" class="form-control">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row row-sm">
								<div class="col-lg mg-t-10 mg-lg-t-0">
									<label for="notes"><span class="font-weight-bold">{{ trans('site.notes') }}</span></label>
									<textarea  name="notes" id="notes" class="form-control"></textarea>
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