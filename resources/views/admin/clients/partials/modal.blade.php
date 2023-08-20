<!-- Modal effects -->
	<div class="modal" id="addClient">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
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
									<label for="name"><small class="font-weight-bold">{{ trans('site.name') }}</small></label>
									<input type="text" name="name" id="client_name" class="form-control" autofocus>
								</div>
								<div class="col-lg mg-t-10 mg-lg-t-0">
									<label for="id_number"><small class="font-weight-bold">{{ trans('site.id_number') }}</small></label>
									<input type="number" name="id_number" id="id_number" class="form-control">
								</div>
								<div class="col-lg mg-t-10 mg-lg-t-0">
									<label for="cr_number"><small class="font-weight-bold">{{ trans('site.cr_number') }}</small></label>
									<input type="number" name="cr_number" id="cr_number" class="form-control">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row row-sm">
								<div class="col-lg mg-t-10 mg-lg-t-0">
									<label for="po_box"><small class="font-weight-bold">{{ trans('site.po_box') }}</small></label>
									<input type="text" name="po_box" id="po_box" class="form-control">
								</div>
								<div class="col-lg mg-t-10 mg-lg-t-0">
									<label for="city"><small class="font-weight-bold">{{ trans('site.city') }}</small></label>
									<input type="text" name="city" id="city" class="form-control">
								</div>
								<div class="col-lg-8 mg-t-10 mg-lg-t-0">
									<label for="address"><small class="font-weight-bold">{{ trans('site.address') }}</small></label>
									<input type="text" name="address" id="address" class="form-control">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row row-sm">
								<div class="col-lg mg-t-10 mg-lg-t-0">
									<label for="mobile"><small class="font-weight-bold">{{ trans('site.mobile') }}</small></label>
									<input type="number" name="mobile" id="mobile" class="form-control">
								</div>
								<div class="col-lg mg-t-10 mg-lg-t-0">
									<label for="phone"><small class="font-weight-bold">{{ trans('site.phone') }}</small></label>
									<input type="number" name="phone" id="phone" class="form-control">
								</div>
								<div class="col-lg mg-t-10 mg-lg-t-0">
									<label for="email"><small class="font-weight-bold">{{ trans('site.email') }}</small></label>
									<input type="text" name="email" id="email" class="form-control">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row row-sm">
								<div class="col-lg mg-t-10 mg-lg-t-0">
									<label for="nationality"><small class="font-weight-bold">{{ trans('site.nationality') }}</small></label>
									<input type="text" name="nationality" id="nationality" class="form-control">
								</div>
								<div class="col-lg mg-t-10 mg-lg-t-0">
									<label for="user_name"><small class="font-weight-bold">{{ trans('site.user_name') }}</small></label>
									<input type="text" name="user_name" id="user_name" class="form-control">
								</div>
								<div class="col-lg mg-t-10 mg-lg-t-0">
									<label for="password"><small class="font-weight-bold">{{ trans('site.password') }}</small></label>
									<input type="password" name="password" id="password" class="form-control">
								</div>
								<div class="col-lg mg-t-10 mg-lg-t-0">
									<label for="status"><small class="font-weight-bold">{{ trans('site.client_status') }}</small></label>
									<select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
										<option>{{ trans('site.select_attr', ['attr' => trans('site.client_status')]) }}</option>
										<option value="1">{{ trans('site.active') }}</option>
										<option value="0">{{ trans('site.in_active') }}</option>
									</select>
									@error('status')
                                        <span class="text-danger small" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row row-sm">
								<div class="col-lg mg-t-10 mg-lg-t-0">
									<label for="notes"><small class="font-weight-bold">{{ trans('site.notes') }}</small></label>
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
