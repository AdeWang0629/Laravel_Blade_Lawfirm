@extends('layouts.admin.master')

@section('title', trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.lawsuites', 0), 2)]))

@section('css')
	<!-- Internal Select2 css -->
	<link href="{{URL::asset('admin_assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
	<!--Internal  Datetimepicker-slider css -->
	<link href="{{URL::asset('admin_assets/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css')}}" rel="stylesheet">
	<link href="{{URL::asset('admin_assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css')}}" rel="stylesheet">
	<link href="{{URL::asset('admin_assets/plugins/pickerjs/picker.min.css')}}" rel="stylesheet">
	<!-- Internal Spectrum-colorpicker css -->
	<link href="{{URL::asset('admin_assets/plugins/spectrum-colorpicker/spectrum.css')}}" rel="stylesheet">
	<style>
		label {
			font-size: 12px;
			font-weight: bold;
			margin-bottom: 0.3rem !important;
		}
        div:first-of-type[data-repeater-item] .btn-block.delete-opponent:first-of-type[data-repeater-delete] { display: none; }
        div:first-of-type[data-repeater-list] div:not(:first-of-type[data-repeater-item]) > .row {
			border-top: 1px solid #e3e8f7 !important;
			padding-top: 1rem;
		}
	</style>
@endsection
@section('page-header')
	<!-- breadcrumb -->
	<div class="breadcrumb-header justify-content-between">
		<div class="my-auto">
			<div class="d-flex">
				<h4 class="content-title mb-0 my-auto">{{ trans('site.home') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.lawsuites', 0), 2)]) }}</span>
			</div>
		</div>
		@canany(['clientType_create', 'caseType_create'])
			<div class="d-flex my-xl-auto right-content">
				<div class="pr-1 mb-3 mb-xl-0">
					@can('clientType_create')
						<button type="button" class="btn btn-sm btn-info modal-effect"  data-effect="effect-slide-in-right" data-toggle="modal" data-target="#clientType"
						data-url="{{ route('admin.clients-types.store') }}"
						data-submit_btn="{{ trans('site.add') }}"
						data-label_name="{{ trans('site.name') }}"
						data-modal_title="{{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.categories', 0), 2) .' '. removebeginninLetters(trans_choice('site.clients', 0), 2)]) }}"
						data-method=""><i class="mdi mdi-plus"></i> {{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.categories', 0), 2) .' '. removebeginninLetters(trans_choice('site.clients', 0), 2)]) }}</button>
					@else
						<button type="button" class="btn btn-sm btn-info disabled"><i class="mdi mdi-plus"></i> {{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.categories', 0), 2) .' '. removebeginninLetters(trans_choice('site.clients', 0), 2)]) }}</button>
					@endcan
				</div>

				<div class="pr-1 mb-3 mb-xl-0">
					@can('caseType_create')
						<button type="button" class="btn btn-sm btn-primary modal-effect"  data-effect="effect-slide-in-right" data-toggle="modal" data-target="#caseType"
						data-url="{{ route('admin.case-types.store') }}"
						data-submit_btn="{{ trans('site.add') }}"
						data-label_name="{{ trans('site.name_attr', ['attr' => trans_choice('site.categories', 0)]) }}"
						data-modal_title="{{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.categories', 0), 2)]) }}"
						data-method=""><i class="mdi mdi-plus"></i> {{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.categories', 0), 2)]) }}</button>
					@else
						<button type="button" class="btn btn-sm btn-primary disabled"><i class="mdi mdi-plus"></i> {{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.categories', 0), 2)]) }}</button>
					@endcan
				</div>
			</div>
		@endcanany
	</div>
	<!-- breadcrumb -->
@endsection
@section('content')
		@include('layouts.admin._partials.errors')
		<form action="{{ route('admin.lawsuites.store') }}" method="POST">
			@csrf

			<!-- row -->
			<div class="row">
				<div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
					<div class="card  box-shadow-0 ">
						<div class="card-header">
							<h4 class="card-title mb-1 text-primary">{{ trans('site.info_attr', ['attr' => trans_choice('site.clients', 0)]) }}</h4>
						</div>
						<div class="card-body pt-0">
							<div class="row">
								<div class="form-group col-lg">
									<label for="exampleInputEmail1">{{ trans('site.choose_attr', ['attr' => removebeginninLetters(trans_choice('site.clients', 0), 2)]) }}</label>
									<select class="form-control @error('client_id') is-invalid @enderror clients" name="client_id">
										<option></option>
										@foreach ($clients as $client)
											<option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
										@endforeach
									</select>
									@error('client_id')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
								<div class="form-group col-lg">
									<label for="exampleInputEmail1">{{ trans('site.choose_attr', ['attr' => removebeginninLetters(trans_choice('site.categories', 0), 2) .' '. trans_choice('site.clients', 0)]) }}</label>
									<select class="form-control @error('client_type_id') is-invalid @enderror clients" name="client_type_id">
										<option></option>
										@foreach ($clientTypes as $clientType)
											<option value="{{ $clientType->id }}" {{ old('client_type_id') == $clientType->id ? 'selected' : '' }}>{{ $clientType->name }}</option>
										@endforeach
									</select>
									@error('client_type_id')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- row -->
			<div class="row">
				<div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
					<div class="card box-shadow-0 {{ $errors->get('opponents.*') || $errors->get('opponents') ? 'border border-danger' : '' }}">
						<div class="card-header">
							<h4 class="card-title mb-1 text-primary">{{ trans('site.info_attr', ['attr' => trans_choice('site.opponents', 1)]) }}</h4>
						</div>
						<div class="card-body pt-0">
							<div class="repeater">
								<div data-repeater-list="opponents">
									<div data-repeater-item>
										<div class="row mb-3">
											<div class="form-group col-lg">
												<label for="opponent_name">{{ trans('site.name_attr', ['attr' => trans_choice('site.opponents', 0)]) }}</label>
												<input type="text" class="form-control @error('opponent_name') is-invalid @enderror" name="opponent_name" id="opponent_name" placeholder="{{ trans('site.name_attr', ['attr' => trans_choice('site.opponents', 0)]) }}" value="{{ old('opponent_name') }}">
												@error('opponent_name')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
											</div>
											<div class="form-group col-lg">
												<label for="opponent_phone">{{ trans('site.phone_attr', ['attr' => trans_choice('site.opponents', 0)]) }}</label>
												<input type="tel" class="form-control @error('opponent_phone') is-invalid @enderror" name="opponent_phone" id="opponent_phone" placeholder="{{ trans('site.phone_attr', ['attr' => trans_choice('site.opponents', 0)]) }}" value="{{ old('opponent_phone') }}">
												@error('opponent_phone')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
											</div>
											<div class="form-group col-lg">
												<label for="opponent_section">{{ trans_choice('site.stations', 0) }}</label>
												<input type="text" class="form-control @error('opponent_section') is-invalid @enderror" name="opponent_section" id="opponent_section" value="{{ old('opponent_section') }}" placeholder="{{ trans_choice('site.stations', 0) }}">
												@error('opponent_section')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
											</div>
											<div class="form-group col-lg">
												<label for="opponent_city">{{ trans('site.city') }}</label>
												<input type="text" class="form-control @error('opponent_city') is-invalid @enderror" name="opponent_city" id="opponent_city" value="{{ old('opponent_city') }}" placeholder="{{ trans('site.city') }}">
												@error('opponent_city')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
											</div>
											<div class="w-100"></div>
											<div class="form-group col-lg">
												<label for="opponent_address">{{ trans('site.address_attr', ['attr' => trans_choice('site.opponents', 0)]) }}</label>
												<input type="text" class="form-control @error('opponent_address') is-invalid @enderror" name="opponent_address" id="opponent_address" placeholder="{{ trans('site.address_attr', ['attr' => trans_choice('site.opponents', 0)]) }}" value="{{ old('opponent_address') }}">
												@error('opponent_address')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
											</div>
											<div class="form-group col-lg">
												<label for="opponent_lawyer">{{ trans('site.lawyer_attr', ['attr' => trans_choice('site.opponents', 0)]) }}</label>
												<input type="text" class="form-control @error('opponent_lawyer') is-invalid @enderror" name="opponent_lawyer" id="lawsuite_lawyer" placeholder="{{ trans('site.lawyer_attr', ['attr' => trans_choice('site.opponents', 0)]) }}" value="{{ old('opponent_lawyer') }}">
												@error('opponent_lawyer')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
											</div>
											<div class="form-group col-lg">
												<label for="opponent_lawyer_phone">{{ trans('site.lawyer_phone_attr', ['attr' => trans_choice('site.opponents', 0)]) }}</label>
												<input type="text" class="form-control @error('opponent_lawyer_phone') is-invalid @enderror" name="opponent_lawyer_phone" id="opponent_lawyer_phone" placeholder="{{ trans('site.lawyer_phone_attr', ['attr' => trans_choice('site.opponents', 0)]) }}" value="{{ old('opponent_lawyer_phone') }}">
												@error('opponent_lawyer_phone')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
											</div>
											<div class="form-group col-lg">
												<label><br></label>
												<input class="btn btn-danger btn-block delete-opponent" data-repeater-delete type="button" value="{{ trans('site.delete') }}" />
											</div>
										</div>
									</div>
									<div data-repeater-item></div>
								</div>
								<div class="row mt-2">
									<div class="col-12">
										<input class="btn btn-success btn-sm" data-repeater-create type="button" value="{{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.opponents', 0), 2)]) }}" />
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- row -->
			<div class="row">
				<!--div-->
				<div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
					<div class="card  box-shadow-0 ">
						<div class="card-header">
							<h4 class="card-title mb-1 text-primary">{{ trans('site.info_attr', ['attr' => trans_choice('site.lawsuites', 0)]) }}</h4>
						</div>
						<div class="card-body pt-0">
							<div class="row">
								<div class="form-group col-lg">
									<label for="exampleInputEmail1">{{ trans('site.choose_attr', ['attr' => removebeginninLetters(trans_choice('site.categories', 0), 2) .' '. trans_choice('site.lawsuites', 0)]) }}</label>
									<select class="form-control @error('case_type_id') is-invalid @enderror clients" name="case_type_id">
										<option></option>
										@foreach ($caseTypes as $caseType)
											<option value="{{ $caseType->id }}" {{ old('case_type_id') == $caseType->id ? 'selected' : '' }}>{{ $caseType->name }}</option>
										@endforeach
									</select>
									@error('case_type_id')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
								<div class="form-group col-lg">
									<label for="lawsuite_lawyer">{{ trans('site.lawyer_attr', ['attr' => trans_choice('site.lawsuites', 0)]) }}</label>
									<input type="text" class="form-control @error('lawsuite_lawyer') is-invalid @enderror" name="lawsuite_lawyer" id="lawsuite_lawyer" placeholder="{{ trans('site.lawyer_attr', ['attr' => trans_choice('site.lawsuites', 0)]) }}" value="{{ old('lawsuite_lawyer') }}">
									@error('lawsuite_lawyer')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
								<div class="form-group col-lg-6">
									<label for="lawsuite_subject">{{ removebeginninLetters(trans('site.subject'), 2) . ' ' . trans_choice('site.lawsuites', 0) }}</label>
									<input type="text" class="form-control @error('lawsuite_subject') is-invalid @enderror" name="lawsuite_subject" id="lawsuite_subject" placeholder="{{ removebeginninLetters(trans('site.subject'), 2) . ' ' . trans_choice('site.lawsuites', 0) }}" value="{{ old('lawsuite_subject') }}">
									@error('lawsuite_subject')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
								<div class="w-100"></div>
								<div class="form-group col-lg">
									<label for="opponent_address">{{ trans('site.choose_attr', ['attr' => removebeginninLetters(trans_choice('site.stages', 0), 2) .' '. trans('site.litigation')]) }}</label>
									<select class="form-control @error('case_stage_id') is-invalid @enderror clients" name="case_stage_id">
										<option></option>
										@foreach ($caseStages as $caseStage)
											<option value="{{ $caseStage->id }}" {{ old('case_stage_id') == $caseStage->id ? 'selected' : '' }}>{{ $caseStage->name }}</option>
										@endforeach
									</select>
									@error('case_stage_id')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
								<div class="form-group col-lg">
									<label for="opponent_lawyer">{{ trans('site.choose_attr', ['attr' => trans_choice('site.status', 0) .' '. trans_choice('site.lawsuites', 0)]) }}</label>
									<select class="form-control @error('lawsuit_case_id') is-invalid @enderror clients" name="lawsuit_case_id">
										<option></option>
										@foreach ($lawsuiteCases as $lawsuiteCase)
											<option value="{{ $lawsuiteCase->id }}" {{ old('lawsuit_case_id') == $lawsuiteCase->id ? 'selected' : '' }}>{{ $lawsuiteCase->name }}</option>
										@endforeach
									</select>
									@error('lawsuit_case_id')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
								<div class="form-group col-lg">
									<label for="opponent_lawyer">{{ trans('site.choose_attr', ['attr' => trans_choice('site.courts', 0)]) }}</label>
									<select class="form-control @error('court_id') is-invalid @enderror clients" name="court_id">
										<option></option>
										@foreach ($courts as $court)
											<option value="{{ $court->id }}" {{ old('court_id') == $court->id ? 'selected' : '' }}>{{ $court->name }}</option>
										@endforeach
									</select>
									@error('court_id')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
								<div class="form-group col-lg">
									<label for="court_case_number">{{ trans('site.court_lawsuite_number') }}</label>
									<input type="text" class="form-control @error('court_case_number') is-invalid @enderror" name="court_case_number" id="court_case_number" placeholder="{{ trans('site.court_lawsuite_number') }}" value="{{ old('court_case_number') }}">
									@error('court_case_number')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
						</div>
					</div>
					<div class="card box-shadow-0 ">
						<div class="card-header">
							<h4 class="card-title mb-1 text-primary">{{ trans('site.info_attr', ['attr' => trans_choice('site.contracts', 0)]) }}</h4>
						</div>

						<div class="card-body pt-0">
							<div class="row">
                                <div class="form-group col-lg">
                                    <label for="contract_amount">{{ trans('site.title') }}</label>
									<input type="text" class="form-control @error('contract_title') is-invalid @enderror" name="contract_title" id="contract_title" placeholder="{{ trans('site.title') }}" value="{{ old('contract_title', getSettingOf('contract_title')) }}">
									@error('contract_title')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
                                </div>
                            </div>
							<div class="row">
								<div class="form-group col-lg">
									<label for="contract_amount">{{ trans('site.date_attr', ['attr' => trans_choice('site.contracts', 0)]) }}</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<div class="input-group-text">
												<i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
											</div>
										</div><input class="form-control @error('contract_date') is-invalid @enderror fc-datepicker" name="contract_date" placeholder="MM/DD/YYYY" type="text" value="{{ old('contract_date', now()->format('Y-m-d')) }}">
									</div>
									@error('contract_date')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
								<div class="form-group col-lg">
									<label for="contract_amount">{{ trans('site.amount_attr', ['attr' => trans_choice('site.contracts', 0)]) }}</label>
									<input type="number" min="0" step="any" class="form-control @error('contract_amount') is-invalid @enderror" name="contract_amount" id="contract_amount" placeholder="{{ trans('site.amount_attr', ['attr' => trans_choice('site.contracts', 0)]) }}" value="{{ old('contract_amount') }}">
									@error('contract_amount')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
								<div class="form-group col-lg">
									<label for="vat">{{ trans('site.amount_attr', ['attr' => trans('site.vat')]) }}</label>
									<input type="number" min="0" step="any" class="form-control @error('vat') is-invalid @enderror" name="vat" id="vat" placeholder="{{ trans('site.amount_attr', ['attr' => trans('site.vat')]) }}" value="{{ old('vat', getSettingOf('vat')) }}">
									@error('vat')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
								<div class="form-group col-lg">
									<label for="total_amount">{{ trans('site.contract_amount_including_tax') }}</label>
									<input type="number" min="0" step="any" class="form-control @error('total_amount') is-invalid @enderror" name="total_amount" id="total_amount" placeholder="{{ trans('site.contract_amount_including_tax') }}" value="{{ old('total_amount') }}" readonly>
									@error('total_amount')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
								<div class="w-100"></div>
								<div class="form-group col-lg">
									<label for="contract_terms">{{ trans('site.contract_terms') }}</label>
									<textarea name="contract_terms" class="form-control @error('contract_terms') is-invalid @enderror contract_textarea" name="contract_terms" id="contract_terms" placeholder="{{ trans('site.contract_terms') }}">{{ old('contract_terms') }}</textarea>
									@error('contract_terms')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
								<div class="w-100"></div>
								<div class="form-group col-lg">
									<label for="notes">{{ trans('site.notes') }}</label>
									<textarea class="form-control @error('notes') is-invalid @enderror" name="notes" id="notes" rows="4" placeholder="{{ trans('site.notes') }}">{{ old('notes') }}</textarea>
									@error('notes')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
							<button class="btn ripple btn-primary save-btn w-100" type="submit">{{ trans('site.add') }}</button>
						</div>
					</div>
				</div>
				<!--/div-->
			</div>
			<!-- row closed -->
		</form>

		</div>
		<!-- Container closed -->
	</div>
	<!-- main-content closed -->
	@can('clientType_create')
		@include('admin.clients-types.partials.modal')
	@endcan

	@canany(['caseType_create', 'caseType_edit'])
		@include('admin.cases-types.partials.modal')
	@endcanany
@endsection
@section('js')
	<!--Internal  Datepicker js -->
	<script src="{{URL::asset('admin_assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
	<!-- Internal Select2.min js -->
	<script src="{{URL::asset('admin_assets/plugins/select2/js/select2.min.js')}}"></script>
	<script src="{{URL::asset('admin_assets/plugins/select2/js/i18n/ar.js')}}"></script>
	<!--Internal tinymce js -->
	<script src="{{URL::asset('admin_assets/plugins/tinymce/tinymce.min.js')}}"></script>
	<script src="{{URL::asset('admin_assets/plugins/tinymce/langs/ar.js')}}"></script>
	<!--repeater js -->
    <script src="{{ asset('admin_assets/js/repeater.js') }}"></script>
	<script>
		$(function() {
			'use strict'

			$('.clients').select2({
				placeholder: "{{ trans('site.choose_attr', ['attr' => '']) }}",
				language: 'ar',
				dir: "rtl",
			});

			$('.fc-datepicker').datepicker({
				dateFormat: 'yy-mm-dd',
				showOtherMonths: true,
				selectOtherMonths: true
			});

			@can(['clientType_create'])
				// hide modal with effect
				$('#clientType').on('shown.bs.modal', function(event) {
					var button = $(event.relatedTarget), // Button that triggered the modal
					url = button.data('url'),
					method = button.data('method'),
					submit_btn = button.data('submit_btn'),
					modal_title = button.data('modal_title'),
					label_name = button.data('label_name'),
					modal = $(this);

					modal.find('.modal-content').find('form').attr('action', url)
					modal.find('.modal-title').text(modal_title)
					modal.find('.label_name').text(label_name)
					modal.find('#client_type_name').focus()

					modal.find('.save-btn').text(submit_btn)
					if(submit_btn == "{{ trans('site.add') }}") {
						$('.save-btn').removeClass('btn-primary').addClass('btn-success');
					}
				});
			@endcan

			@can('caseType_create')
				// hide modal with effect
				$('#caseType').on('shown.bs.modal', function(event) {
					var button = $(event.relatedTarget), // Button that triggered the modal
					url = button.data('url'),
					method = button.data('method'),
					submit_btn = button.data('submit_btn'),
					modal_title = button.data('modal_title'),
					label_name = button.data('label_name'),
					modal = $(this);

					modal.find('.modal-content').find('form').attr('action', url)
					modal.find('.modal-title').text(modal_title)
					modal.find('.label_name').text(label_name)
					modal.find('input[name=_method]').val(method)
					modal.find('.save-btn').text(submit_btn)
					modal.find('#case_type_name').focus();

					if(submit_btn == "{{ trans('site.add') }}") {
						modal.find('.save-btn').removeClass('btn-primary btn-danger').addClass('btn-success');
					}
				});
			@endcan

			tinymce.init({
				selector: 'textarea.contract_textarea', // change this according to your HTML
				language: 'ar',
				height : "600",
				directionality : 'rtl',
				plugins: 'lists',
				toolbar: [
					{ name: 'history', items: [ 'undo', 'redo' ] },
					{ name: 'styles', items: [ 'styles' ] },
					{ name: 'formatting', items: [ 'bold', 'italic' ] },
					{ name: 'alignment', items: [ 'alignleft', 'aligncenter', 'alignright', 'alignjustify' ] },
					{ name: 'indentation', items: [ 'outdent', 'indent' ] },
					{ name: 'lists', items: [ 'numlist', 'bullist' ] }
				]
			});

			$('body').each(function() {
                $('#contract_amount, #vat').on('keyup change',function() {
                    var that = $(this);
                    that.closest('.row').find('#total_amount').val(0);
                    updateTotal(that);
                });
            });

			var updateTotal = function (that) {
                var contract_amount = parseFloat(that.closest('.row').find('#contract_amount').val());
                var vat = parseFloat(that.closest('.row').find('#vat').val());
                var total_amount  = that.closest('.row').find('#total_amount');
                if (isNaN(contract_amount) || isNaN(vat)) {
                    total_amount.val(0);
                } else {
                    var finalTotal = parseFloat((vat / 100) * contract_amount) + contract_amount;
                    total_amount.val(finalTotal.toFixed(2));
                }
            };

			var repeater = $('.repeater').repeater({
                isFirstItemUndeletable: true,
                show: function () {
                    $(this).slideDown();
                },
            });

			@if ( count(session()->getOldInput()) )
                repeater.setList(@json(session()->getOldInput()['opponents'] ?? ''));
            @endif
		});
	</script>
@endsection
