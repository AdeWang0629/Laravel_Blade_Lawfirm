<!-- Modal effects -->
<div class="modal" id="addReceipts">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content modal-content-demo">
			<div class="modal-header">
				<h6 class="modal-title"></h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
			</div>
			<form class="form-horizontal" action="#" method="POST">
				@csrf
				<input type="hidden" name="_method">
				<input type="hidden" name="id">

				<input type="hidden" name="lawsuite_id">
				<input type="hidden" name="consultation_id">
				<input type="hidden" name="client_id">
				<div class="modal-body">
					<div class="form-group">
						<div class="row row-sm">
							<div class="col-lg mg-t-10 mg-lg-t-0">
								<label for="title">{{ removebeginninLetters(trans('site.title'), 2) .' '. trans_choice('site.payments', 0) }}</label>
								<input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ old('title') }}">
							</div>
							<div class="col-lg mg-t-10 mg-lg-t-0">
								<label for="debit">{{ trans('site.amount_attr', ['attr' => trans_choice('site.payments', 0)]) }}</label>
								<input type="number" name="debit" class="form-control @error('debit') is-invalid @enderror" id="debit" value="{{ old('debit') }}">
							</div>
							<div class="col-lg mg-t-10 mg-lg-t-0">
								<label for="date">{{ trans('site.date_attr', ['attr' => trans_choice('site.payments', 0)]) }}</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text">
											<i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
										</div>
									</div><input class="form-control @error('date') is-invalid @enderror fc-datepicker" name="date" placeholder="MM/DD/YYYY" type="text" value="{{ old('date', now()->format('Y-m-d')) }}">
								</div>
							</div>
							<div class="col-lg mg-t-10 mg-lg-t-0">
								<label for="payment_type">{{ trans('site.payment_way') }}</label>
								<input type="text" class="form-control @error('payment_type') is-invalid @enderror" id="payment_type" name="payment_type" value="{{ old('payment_type') }}">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row row-sm">
							<div class="col-lg">
								<label for="note">{{ trans('site.thats_about') }}</label>
								<input type="text" class="form-control @error('note') is-invalid @enderror" id="note" name="note" value="{{ old('note') }}">
								@error('note')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
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