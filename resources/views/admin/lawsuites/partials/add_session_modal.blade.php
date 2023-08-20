<!-- Modal effects -->
<div class="modal" id="addCaseSession">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content modal-content-demo">
			<div class="modal-header">
				<h6 class="modal-title">{{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.sessions', 0), 2)]) }}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
			</div>
			<form class="form-horizontal" action="{{ route('admin.case-sessions.store') }}" method="POST">
				@csrf
				<input type="hidden" name="lawsuite_id">
				<input type="hidden" name="court_id">
				<div class="modal-body">
					<div class="form-group">
						<div class="row row-sm">
							<div class="col-lg mg-t-10 mg-lg-t-0">
								<label for="title">{{ removebeginninLetters(trans('site.title'), 2) .' '. trans_choice('site.sessions',0) }}</label>
								<input type="text" name="title" class="title form-control @error('title') is-invalid @enderror" id="title" value="{{ old('title') }}">
							</div>
							<div class="col-lg mg-t-10 mg-lg-t-0">
								<label for="start">{{ trans('site.date_attr', ['attr' => trans_choice('site.sessions', 0)]) }}</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text">
											<i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
										</div>
									</div><input class="form-control @error('start') is-invalid @enderror fc-datepicker" name="start" placeholder="MM/DD/YYYY" type="text" value="{{ old('start') }}">
								</div>
							</div>
							<div class="col-lg mg-t-10 mg-lg-t-0">
								<label for="bg_color">{{ trans('site.bg_color_for_calendar') }}</label>
								<input type="text" id="bg_color" name="bg_color" value="{{ old('bg_color') }}">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row row-sm">
							<div class="col-lg">
								<label for="session_details">{{ removebeginninLetters(trans('site.details'), 2) .' '. trans_choice('site.sessions',0) }}</label>
								<textarea name="session_details" class="form-control @error('session_details') is-invalid @enderror contract_textarea" name="session_details" id="session_details" placeholder="{{ removebeginninLetters(trans('site.details'), 2) .' '. trans_choice('site.sessions',0) }}">{{ old('session_details') }}</textarea>
								@error('session_details')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn ripple btn-success save-btn" type="submit">{{ trans('site.add') }}</button>
					<button class="btn ripple btn-secondary close-btn" data-dismiss="modal" type="button">{{ trans('site.cancel') }}</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- End Modal effects-->
