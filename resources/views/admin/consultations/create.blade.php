@extends('layouts.admin.master')

@section('title', trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.consultations', 0), 2)]))

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
</style>
@endsection
@section('page-header')
	<!-- breadcrumb -->
	<div class="breadcrumb-header justify-content-between">
		<div class="my-auto">
			<div class="d-flex">
				<h4 class="content-title mb-0 my-auto">{{ trans('site.home') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.consultations', 0), 2)]) }}</span>
			</div>
		</div>
		<div class="d-flex my-xl-auto right-content">
			<div class="pr-1 mb-3 mb-xl-0">
				@can('client_create')
					<button type="button" class="btn btn-sm btn-warning modal-effect"  data-effect="effect-slide-in-right" data-toggle="modal" data-target="#addClient"
					data-url="{{ route('admin.clients.store') }}"
					data-submit_btn="{{ trans('site.add') }}"
					data-modal_title="{{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.clients', 0), 2)]) }}"
					data-method=""><i class="mdi mdi-plus"></i> {{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.clients', 0), 2)]) }}</button>
				@else
					<button type="button" class="btn btn-sm btn-warning disabled"><i class="mdi mdi-plus"></i> {{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.clients', 0), 2)]) }}</button>
				@endcan
			</div>

			<div class="pr-1 mb-3 mb-xl-0">
				@can('consultation_list')
					<a href="{{ route('admin.consultations.index') }}" class="btn btn-sm btn-success">{{ trans('site.all_attr', ['attr' => trans_choice('site.consultations', 1)]) }} <i class="fas fa-long-arrow-alt-left"></i></a>
				@else
					<button type="button" class="btn btn-sm btn-success disabled">{{ trans('site.all_attr', ['attr' => trans_choice('site.consultations', 1)]) }} <i class="fas fa-long-arrow-alt-left"></i></button>
				@endcan
			</div>
		</div>
	</div>
	<!-- breadcrumb -->
@endsection
@section('content')
		@include('layouts.admin._partials.errors')
		<form action="{{ route('admin.consultations.store') }}" method="POST">
			@csrf
			
			<!-- row -->
			<div class="row">
				<!--div-->
				<div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
					<div class="card  box-shadow-0 ">
						<div class="card-header">
							<h4 class="card-title mb-1 text-primary">{{ trans('site.info_attr', ['attr' => trans_choice('site.consultations', 0)]) }}</h4>
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
									<label for="consultation_subject">{{ removebeginninLetters(trans('site.subject'), 2) . ' ' . trans_choice('site.consultations', 0) }}</label>
									<input type="text" class="form-control @error('consultation_subject') is-invalid @enderror" name="consultation_subject" id="consultation_subject" placeholder="{{ removebeginninLetters(trans('site.subject'), 2) . ' ' . trans_choice('site.consultations', 0) }}" value="{{ old('consultation_subject') }}">
									@error('consultation_subject')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
								<div class="w-100"></div>
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
							</div>
						</div>
					</div>
					<div class="card box-shadow-0 ">
						<div class="card-header">
							<h4 class="card-title mb-1 text-primary">{{ trans('site.info_attr', ['attr' => trans_choice('site.contracts', 0)]) }}</h4>
						</div>
						<div class="card-body pt-0">
							<div class="row">
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

	@can('client_create')
		@include('admin.clients.partials.modal')
	@endcan
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

			@can('client_create')
				// hide modal with effect
				$('#addClient').on('shown.bs.modal', function(event) {
					var button = $(event.relatedTarget), // Button that triggered the modal
					url 			= button.data('url'),
					method 			= button.data('method'),
					submit_btn 		= button.data('submit_btn'),
					modal_title 	= button.data('modal_title'),

					modal = $(this);
					modal.find('#client_name').focus();
					modal.find('.modal-content').find('form').attr('action', url)
					modal.find('.modal-title').text(modal_title)
					modal.find('input[name=_method]').val(method)
					modal.find('.save-btn').text(submit_btn)

					if(submit_btn == "{{ trans('site.add') }}") {
						modal.find('.save-btn').removeClass('btn-primary btn-danger').addClass('btn-success');
					}
				});
			@endcan
			
			tinymce.init({
				selector: 'textarea.contract_textarea', // change this according to your HTML
				language: 'ar',
				height : "300",
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

		});
	</script>
@endsection
