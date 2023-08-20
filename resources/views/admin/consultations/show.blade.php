@extends('layouts.admin.master')

@section('title', trans('site.show_attr', ['attr' => trans_choice('site.consultations', 0)]).': '.$consultation->consultation_number)

@section('css')
	<!-- Internal Select2 css -->
	<link href="{{URL::asset('admin_assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
	<!-- Internal Data table css -->
	<link href="{{URL::asset('admin_assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
	<link href="{{URL::asset('admin_assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
	<link href="{{URL::asset('admin_assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
	<link href="{{URL::asset('admin_assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
	<link href="{{URL::asset('admin_assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
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
		.main-profile-overview .main-img-user i {
			line-height: 120px;
		}
		.main-profile-name {
			font-weight: normal !important;
		}
		.case-info {
			font-size: 13px;
			margin-bottom: 5px;
		}
		.main-profile-name {
			font-size: 16px !important;
			padding-bottom: 5px !important;
			margin-bottom: 10px !important;
			border-bottom: 1px solid rgba(0, 0, 0, 0.1);
		}
		.counter-icon {
			display: block !important;
			width: 45px !important;
			height: 45px !important;
			line-height: 50px !important;
			padding: 0px !important;
		}
		.counter-icon i {
			font-size: 18px !important;
		}
		.ui-datepicker.ui-widget-content {
			z-index: 999999 !important;
		}
		.select2-container {
			width: 100% !important;
		}
		.sp-container {
			z-index: 99999 !important;
		}
		.sp-replacer.sp-light {
			display: block;
			width: 100%;
			height: 40px;
			padding: 0.375rem 0.75rem;
			font-size: 0.875rem;
			font-weight: 400;
			line-height: 1.5;
			color: #4d5875;
			background-color: #fff;
			background-clip: padding-box;
			border: 1px solid #e1e5ef;
			border-radius: 3px;
			transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
		}
		.sp-preview {
			width: calc(100% - 20px);
			height: -webkit-fill-available;
			margin-right: 10px;
		}
		.sp-dd {
			height: 25px;
			line-height: 22px;
		}
		.accordion .card-body {
			padding: 20px 20px !important;
			background-color: #ffffff !important;
		}
		.main-contact-info-header {
			padding-right: 30px;
		}
		.main-contact-info-header .media-body {
			margin-top: 0 !important;
			margin-right: 30px;
		}
	</style>
@endsection
@section('page-header')
	<!-- breadcrumb -->
	<div class="breadcrumb-header justify-content-between">
		<div class="my-auto">
			<div class="d-flex">
				<h4 class="content-title mb-0 my-auto">{{ trans('site.home') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('site.show_attr', ['attr' => trans_choice('site.consultations', 0)]).': '.$consultation->consultation_number }}</span>
			</div>
		</div>
		<div class="d-flex my-xl-auto right-content">
			<div class="pr-1 mb-3 mb-xl-0">
				@can('consultation_edit')
					<a href="{{ route('admin.consultations.edit', $consultation) }}" class="btn btn-sm btn-primary">{{ trans('site.edit', ['attr' => trans_choice('site.consultations', 0)]) }} <i class="fas fa-edit"></i></a>
				@else
					<button type="button" class="btn btn-sm btn-primary disabled">{{ trans('site.edit', ['attr' => trans_choice('site.consultations', 0)]) }} <i class="fas fa-edit"></i></button>
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
			<!-- row -->
			<div class="row row-sm">
				<div class="col-lg-3">
					<div class="main-content-body main-content-body-contacts card custom-card">
						<div class="main-contact-info-header pt-3">
							<div class="media d-flex">
								<div class="main-img-user text-danger">
									<i class="fas fa-4x fa-question"></i>
								</div>
								<div class="media-body">
									<h5><span class="text-danger">{{ $consultation->consultation_number }}</span></h5>
									<p class="small text-muted mb-1">{{ removebeginninLetters(trans('site.subject'), 2) . ' ' . trans_choice('site.consultations', 0) }}: {{ $consultation->consultation_subject }}</p>
									<p class="small text-muted mb-0">{{ trans('site.date_attr', ['attr' => trans_choice('site.consultations', 0)]) }}: {{ $consultation->contract_date }}</p>
								</div>
							</div>
							@can('consultation_showContract')
								<a href="{{ route('admin.show.consultation.contract', $consultation) }}" target="_blank" class="btn btn-sm btn-success d-block mt-2">{{ trans('site.print_contract') }}</a>
							@else
								<button type="button" class="btn btn-sm btn-success d-block mt-2 w-100 disabled">{{ trans('site.print_contract') }}</button>
							@endcan
						</div>
						<div class="main-contact-info-body p-4 ps">
							<div class="media-list pb-0">
								<div class="media mb-0">
									<div class="media-body">
										<div>
											<label>{{ trans('site.info_attr', ['attr' => trans_choice('site.clients', 0)]) }}</label>
											<p class="case-info mb-1">
                                                @if ($consultation->client->trashed())
                                                    <span class="text-decoration-line-through text-muted">
                                                @endif
                                                    {{ trans('site.name') }}: <a href="{{ (auth()->user()->can('client_show') ? route('admin.clients.show', $consultation->client_id) : 'javascript:;') }}">{{ $consultation->client->name }}</a>
                                                @if ($consultation->client->trashed())
                                                    </span>
                                                @endif
                                            </p>
											<p class="case-info mb-1">
                                                @if ($consultation->client->trashed())
                                                    <span class="text-decoration-line-through text-muted">
                                                @endif
                                                    {{ trans('site.mobile') }}: <a href="{{ whatsappLink($consultation->client->mobile, 'مرحبا: '.$consultation->client->name) }}">{{ $consultation->client->mobile }}</a>
                                                @if ($consultation->client->trashed())
                                                    </span>
                                                @endif
                                            </p>

											<p class="case-info mb-1">
                                                @if ($consultation->client->trashed())
                                                    <span class="text-decoration-line-through text-muted">
                                                @endif
                                                    {{ trans('site.email') }}: {{ $consultation->client->email }}
                                                @if ($consultation->client->trashed())
                                                    </span>
                                                @endif
                                            </p>
											<p class="case-info mb-1">
                                                @if ($consultation->client->trashed())
                                                    <span class="text-decoration-line-through text-muted">
                                                @endif
                                                    {{ trans('site.nationality') }}: {{ $consultation->client->nationality }}
                                                @if ($consultation->client->trashed())
                                                    </span>
                                                @endif
                                            </p>
											<p class="case-info mb-1">
                                                @if ($consultation->client->trashed())
                                                    <span class="text-decoration-line-through text-muted">
                                                @endif
                                                    {{ trans('site.address') }}: {{ $consultation->client->address }}
                                                @if ($consultation->client->trashed())
                                                    </span>
                                                @endif
                                            </p>
										</div>
									</div>
								</div>
							</div>
						<div class="ps__rail-x" style="left: 0px; top: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 824px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
					</div>
				</div>



				<div class="col-lg-9">
					<div class="row row-sm">
						<div class="col-sm-12 col-xl-3 col-lg-12 col-md-12">
							<div class="card bg-primary-gradient text-white ">
								<div class="card-body">
									<div class="row">
										<div class="col-9">
											<div class="mt-0 text-center">
												<span class="text-white">{{ trans('site.consultation_fee') }}</span>
												<h2 class="text-white mb-0">{{ $consultation->contract_amount }}</h2>

											</div>
										</div>
										<div class="col-3">
											<div class="icon1 mt-2 text-center">
												<i class="fe fe-dollar-sign tx-30"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-xl-3 col-lg-12 col-md-12">
							<div class="card bg-primary-gradient text-white ">
								<div class="card-body">
									<div class="row">
										<div class="col-9">
											<div class="mt-0 text-center">
												<span class="text-white">{{ trans('site.consultation_including_tax') }}</span>
												<h2 class="text-white mb-0">{{ $consultation->total_amount }}</h2>

											</div>
										</div>
										<div class="col-3">
											<div class="icon1 mt-2 text-center">
												<i class="fe fe-clipboard tx-30"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-xl-3 col-lg-12 col-md-12">
							<div class="card bg-danger-gradient text-white">
								<div class="card-body">
									<div class="row">
										<div class="col-9">
											<div class="mt-0 text-center">
												<span class="text-white">{{ trans('site.paid') }}</span>
												<h2 class="text-white mb-0">{{ $consultation->clientAccounts->sum('credit') }}</h2>
											</div>
										</div>
										<div class="col-3">
											<div class="icon1 mt-2 text-center">
												<i class="fe fe-corner-left-up tx-30"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div><div class="col-sm-12 col-xl-3 col-lg-12 col-md-12">
							<div class="card bg-success-gradient text-white">
								<div class="card-body">
									<div class="row">
										<div class="col-9">
											<div class="mt-0 text-center">
												<span class="text-white">{{ trans('site.remaining') }}</span>
												<h2 class="text-white mb-0">{{ $consultation->consultationRemaining }}</h2>
											</div>
										</div>
										<div class="col-3">
											<div class="icon1 mt-2 text-center">
												<i class="fe fe-corner-left-down tx-30"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					@include('layouts.admin._partials.errors')
					<div class="card">
						<div class="card-body">
							<h4 class="tx-15 text-uppercase mb-3 font-weight-bold">{{ removebeginninLetters(trans_choice('site.payments', 1), 2).' '.trans_choice('site.consultations', 0) }}:</h4>

							@can('receipt_create')
								<button type="button" class="btn btn-sm btn-success mb-3 modal-effect"  data-effect="effect-slide-in-right" data-toggle="modal" data-target="#addReceipts"
								data-url="{{ route('admin.receipts.store') }}"
								data-consultation_id="{{ $consultation->id }}"
								data-client_id="{{ $consultation->client_id }}"
								data-submit_btn="{{ trans('site.add') }}"
								data-modal_title="{{ trans('site.add_new', ['attr' => trans('site.receipt')]) }}"
								data-method=""><i class="mdi mdi-plus"></i> {{ trans('site.add_new', ['attr' => trans('site.receipt')]) }}</button>
							@else
								<button type="button" class="btn btn-sm btn-success mb-3 disabled"><i class="mdi mdi-plus"></i> {{ trans('site.add_new', ['attr' => trans('site.receipt')]) }}</button>
							@endcan

							<h4 class="tx-15 text-uppercase mb-3 font-weight-bold">{{ trans_choice('site.payments', 1) }}</h4>
							@can('receipt_list')
								@if ($consultation->receipts->count() > 0)
								<table id="example" class="table table-striped dt-responsive text-center mg-b-0 text-md-nowrap" style="width:100%">
									<thead>
										<tr>
											<th>#</th>
											<th>{{ removebeginninLetters(trans('site.title'), 2) .' '. trans_choice('site.payments', 0) }}</th>
											<th>{{ trans('site.amount_attr', ['attr' => trans_choice('site.payments', 0)]) }}</th>
											<th>{{ trans('site.payment_way') }}</th>
											<th>{{ trans('site.date_attr', ['attr' => trans_choice('site.payments', 0)]) }}</th>
											<th>{{ trans('site.thats_about') }}</th>
											<th>{{ trans('site.actions') }}</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($receipts as $receipt)
										<tr>
											<th scope="row">{{ $loop->iteration }}</th>
											<td>{{ $receipt->title }}</td>
											<td>{{ $receipt->debit }}</td>
											<td>{{ $receipt->payment_type }}</td>
											<td>{{ $receipt->date }}</td>
											<td>{{ $receipt->note }}</td>
											<td>
												<div class="btn-group">
													@can('receipt_showReceipt')
														<a href="{{ route('admin.show.receipt', $receipt) }}" target="_blank" class="btn btn-sm btn-success"><i class="las la-file-pdf"></i></a>
													@else
														<button type="button" class="btn btn-sm btn-success disabled"><i class="las la-file-pdf"></i></button>
													@endcan

													@can('receipt_edit')
														<button type="button" class="btn btn-sm btn-info modal-effect"  data-effect="effect-slide-in-right" data-toggle="modal" data-target="#addReceipts"
														data-url="{{ route('admin.receipts.update', $receipt) }}"
														data-consultation_id="{{ $consultation->id }}"
														data-client_id="{{ $consultation->client_id }}"
														data-id="{{ $receipt->id }}"
														data-title="{{ $receipt->title }}"
														data-debit="{{ $receipt->debit }}"
														data-date="{{ $receipt->date }}"
														data-payment_type="{{ $receipt->payment_type }}"
														data-note="{{ $receipt->note }}"
														data-submit_btn="{{ trans('site.update') }}"
														data-modal_title="{{ trans('site.update_attr', ['attr' => trans('site.receipt')]) }}"
														data-method="PUT"><i class="las la-pen"></i></button>
													@else
														<button type="button" class="btn btn-sm btn-info disabled"><i class="las la-pen"></i></button>
													@endcan

													@can('receipt_delete')
														<button type="button" class="btn btn-sm btn-danger modal-effect"  data-effect="effect-slide-in-right" data-toggle="modal" data-target="#deleteItemModal"
														data-url="{{ route('admin.receipts.destroy', $receipt) }}"
														data-id="{{ $receipt->id }}"
														data-delete_label="{{ trans('site.sure_delete_attr', ['attr' => $receipt->title]) }}"
														data-modal_title="{{ trans('site.delete_attr', ['attr' => trans('site.receipt')]) }}"><i class="las la-trash"></i></button>
													@else
														<button type="button" class="btn btn-sm btn-danger disabled"><i class="las la-trash"></i></button>
													@endcan
												</div>
											</td>
										</tr>
										@endforeach

									</tbody>
								</table>
								@else
									<div class="alert alert-warning" role="alert">{{ trans('site.no_attr_yet', ['attr' => removebeginninLetters(trans_choice('site.payments', 1), 2)]) }}</div>
								@endif
							@else
								<div class="alert alert-warning" role="alert">{{ trans('site.user_does_not_have_the_right_permissions') }}</div>
							@endcan
						</div>
					</div>
				</div>
			</div>
			<!-- row closed -->
		</div>
		<!-- Container closed -->
	</div>
	<!-- main-content closed -->

	@canany(['receipt_create', 'receipt_edit'])
		@include('admin._partials.add_receipt_modal')
	@endcanany
	@can('receipt_delete')
		@include('admin._partials.delete_modal')
	@endcan
@endsection
@section('js')
	<!-- Internal Data tables -->
	<script src="{{URL::asset('admin_assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{URL::asset('admin_assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
	<script src="{{URL::asset('admin_assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
	<script src="{{URL::asset('admin_assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
	<script src="{{URL::asset('admin_assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
	<script src="{{URL::asset('admin_assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
	<script src="{{URL::asset('admin_assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
	<script src="{{URL::asset('admin_assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
	<script src="{{URL::asset('admin_assets/plugins/datatable/js/jszip.min.js')}}"></script>
	<script src="{{URL::asset('admin_assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
	<script src="{{URL::asset('admin_assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
	<script src="{{URL::asset('admin_assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
	<script src="{{URL::asset('admin_assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
	<script src="{{URL::asset('admin_assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
	<script src="{{URL::asset('admin_assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
	<script src="{{URL::asset('admin_assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
	<!--Internal  Datepicker js -->
	<script src="{{URL::asset('admin_assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
	<!--Internal  spectrum-colorpicker js -->
	<script src="{{URL::asset('admin_assets/plugins/spectrum-colorpicker/spectrum.js')}}"></script>
	<!--Internal  pickerjs js -->
	<script src="{{URL::asset('admin_assets/plugins/pickerjs/picker.min.js')}}"></script>
	<!-- Internal Select2.min js -->
	<script src="{{URL::asset('admin_assets/plugins/select2/js/select2.min.js')}}"></script>
	<script src="{{URL::asset('admin_assets/plugins/select2/js/i18n/ar.js')}}"></script>
	<!--Internal tinymce js -->
	<script src="{{URL::asset('admin_assets/plugins/tinymce/tinymce.min.js')}}"></script>
	<script src="{{URL::asset('admin_assets/plugins/tinymce/langs/ar.js')}}"></script>

	<script>
		$(function() {
			'use strict'

			$('.fc-datepicker').datepicker({
				dateFormat: 'yy-mm-dd',
				showOtherMonths: true,
				selectOtherMonths: true
			});

			@canany(['receipt_create', 'receipt_edit'])
				// hide modal with effect
				$('#addReceipts').on('shown.bs.modal', function(event) {
					var button = $(event.relatedTarget), // Button that triggered the modal
					url 				= button.data('url'),
					submit_btn 			= button.data('submit_btn'),
					modal_title 		= button.data('modal_title'),
					method 				= button.data('method'),
					consultation_id		= button.data('consultation_id'),
					client_id			= button.data('client_id'),
					id					= button.data('id'),
					title				= button.data('title'),
					debit				= button.data('debit'),
					date				= button.data('date'),
					payment_type		= button.data('payment_type'),
					note				= button.data('note'),
					modal = $(this);


					modal = $(this);
					modal.find('#title').focus();
					modal.find('.modal-content').find('form').attr('action', url)
					modal.find('.modal-title').text(modal_title)
					modal.find('input[name=_method]').val(method)
					modal.find('input[name=id]').val(id)
					modal.find('input[name=consultation_id]').val(consultation_id)
					modal.find('input[name=client_id]').val(client_id)

					modal.find('#title').val(title)
					modal.find('#debit').val(debit)
					modal.find('input[name=date]').val(date)
					modal.find('#payment_type').val(payment_type)
					modal.find('#note').val(note)

					modal.find('.save-btn').text(submit_btn)

					if(submit_btn == "{{ trans('site.add') }}") {
						modal.find('.save-btn').removeClass('btn-primary btn-danger').addClass('btn-success');
					}
					if(submit_btn == "{{ trans('site.update') }}") {
						modal.find('.save-btn').removeClass('btn-success btn-danger').addClass('btn-primary');
					}
				});
			@endcanany

			@canany(['receipt_delete'])
				// hide modal with effect
				$('#deleteItemModal').on('shown.bs.modal', function(event) {
					var button 			= $(event.relatedTarget), // Button that triggered the modal
						url 			= button.data('url'),
						modal_title 	= button.data('modal_title'),
						id 				= button.data('id'),
						delete_label	= button.data('delete_label'),

					modal = $(this);
					modal.find('.modal-content').find('form').attr('action', url)
					modal.find('.modal-title').text(modal_title)
					modal.find('.delete_label').text(delete_label)
					modal.find('input[name=id]').val(id)
				});
			@endcanany
		});
	</script>
@endsection
