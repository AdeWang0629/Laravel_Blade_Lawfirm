<!-- Modal effects -->
<div class="modal" id="addPayment">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
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
								<label class="label_name" for="receiver"><small class="font-weight-bold">{{ trans('site.receiver') }}</small></label>
								<input type="text" name="receiver" class="form-control @error('receiver') is-invalid @enderror" id="receiver" value="{{ old('receiver') }}">
							</div>
							<div class="col-lg mg-t-10 mg-lg-t-0">
								<label class="label_name" for="exampleInputEmail1"><small class="font-weight-bold">{{ trans('site.choose_attr', ['attr' =>  removebeginninLetters(trans_choice('site.sections', 0), 2)]) }}</small></label>
								<select class="form-control @error('expense_section_id') is-invalid @enderror clients" name="expense_section_id" id="expense_section_id">
									<option></option>
									@foreach ($expenseSections as $expenseSection)
										<option value="{{ $expenseSection->id }}" {{ old('expense_section_id') == $expenseSection->id ? 'selected' : '' }}>{{ $expenseSection->name }}</option>
									@endforeach
								</select>
								@error('expense_section_id')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
							<div class="col-lg mg-t-10 mg-lg-t-0">
								<label class="label_name" for="exampleInputEmail1"><small class="font-weight-bold">{{ trans('site.choose_attr', ['attr' => removebeginninLetters(trans_choice('site.branches', 0), 2)]) }}</small></label>
								<select class="form-control @error('branch_id') is-invalid @enderror clients" name="branch_id" id="branch_id">
									<option></option>
									@foreach ($branches as $branche)
										<option value="{{ $branche->id }}" {{ old('branch_id') == $branche->id ? 'selected' : '' }}>{{ $branche->name }}</option>
									@endforeach
								</select>
								@error('branch_id')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row row-sm">
							<div class="col-lg mg-t-10 mg-lg-t-0">
								<label class="label_name" for="debit"><small class="font-weight-bold">{{ trans('site.amount_attr', ['attr' => trans('site.paid')]) }}</small></label>
								<input type="number" name="debit" class="form-control @error('debit') is-invalid @enderror" id="debit" value="{{ old('debit') }}">
							</div>
							<div class="col-lg mg-t-10 mg-lg-t-0">
								<label class="label_name" for="date"><small class="font-weight-bold">{{ trans('site.date_attr', ['attr' => trans_choice('site.payments', 0)]) }}</small></label>
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text">
											<i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
										</div>
									</div><input class="form-control @error('date') is-invalid @enderror fc-datepicker" name="date" placeholder="MM/DD/YYYY" type="text" value="{{ old('date', now()->format('Y-m-d')) }}">
								</div>
							</div>
							<div class="col-lg mg-t-10 mg-lg-t-0">
								<label class="label_name" for="payment_type"><small class="font-weight-bold">{{ trans('site.payment_way') }}</small></label>
								<input type="text" class="form-control @error('payment_type') is-invalid @enderror" id="payment_type" name="payment_type" value="{{ old('payment_type') }}">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row row-sm">
							<div class="col-lg">
								<label class="label_name" for="note"><small class="font-weight-bold">{{ trans('site.thats_about') }}</small></label>
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
