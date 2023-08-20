@extends('layouts.admin.master')

@section('title', trans('site.show_attr', ['attr' => trans_choice('site.clients', 0)]).': '.$client->name)

@section('css')
	<!-- Internal Data table css -->
	<link href="{{URL::asset('admin_assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
	<link href="{{URL::asset('admin_assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
	<link href="{{URL::asset('admin_assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
	<link href="{{URL::asset('admin_assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
	<link href="{{URL::asset('admin_assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
	<!-- Internal Select2 css -->
	<link href="{{URL::asset('admin_assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
	<!--Internal  Datetimepicker-slider css -->
	<link href="{{URL::asset('admin_assets/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css')}}" rel="stylesheet">
	<link href="{{URL::asset('admin_assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css')}}" rel="stylesheet">
	<link href="{{URL::asset('admin_assets/plugins/pickerjs/picker.min.css')}}" rel="stylesheet">
	<!-- Internal Spectrum-colorpicker css -->
	<link href="{{URL::asset('admin_assets/plugins/spectrum-colorpicker/spectrum.css')}}" rel="stylesheet">
	<style>
		.main-content-body .main-contact-info-header .main-img-user img {
			width: 70px !important;
			height: 70px !important;
		}
		.main-content-body .main-contact-info-header .main-img-user {
			width: 70px !important;
			height: 70px !important;
		}
		label {
			font-size: 12px;
			font-weight: bold;
			margin-bottom: 0.3rem !important;
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
		.main-contact-info-body .media-list {
			padding-top: 0 !important;
		}
		.main-contact-info-body .media + .media::before {
			left: 0 !important;
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
			<h4 class="content-title mb-0 my-auto">{{ trans('site.home') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('site.show_attr', ['attr' => trans_choice('site.clients', 0)]).': '.$client->name }}</span>
		</div>
	</div>
	<div class="d-flex my-xl-auto right-content">
		<div class="pr-1 mb-3 mb-xl-0">
			@can('lawsuite_create')
				<a href="{{ route('admin.lawsuites.create') }}" class="btn btn-sm btn-success"><i class="mdi mdi-plus"></i> {{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.lawsuites', 0), 2)]) }}</a>
			@else
				<button type="button" class="btn btn-sm btn-success disabled"><i class="mdi mdi-plus"></i> {{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.lawsuites', 0), 2)]) }}</</button>
			@endcan
		</div>

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
			@can('client_edit')
				<button type="button" class="btn btn-sm btn-primary modal-effect"  data-effect="effect-slide-in-right" data-toggle="modal" data-target="#addClient"
				data-url="{{ route('admin.clients.update', $client) }}"
				data-client="{{ $client->client }}"
				data-id="{{ $client->id }}"
				data-client_name="{{ $client->name }}"
				data-id_number="{{ $client->id_number }}"
				data-cr_number="{{ $client->cr_number }}"
				data-city="{{ $client->city }}"
				data-address="{{ $client->address }}"
				data-po_box="{{ $client->po_box }}"
				data-mobile="{{ $client->mobile }}"
				data-phone="{{ $client->phone }}"
				data-email="{{ $client->email }}"
				data-status="{{ $client->status }}"
				data-nationality="{{ $client->nationality }}"
				data-user_name="{{ $client->user_name }}"
				data-notes="{{ $client->notes }}"
				data-submit_btn="{{ trans('site.update') }}"
				data-modal_title="{{ trans('site.update_attr', ['attr' => trans_choice('site.clients', 0)]) }}"
				data-method="PUT">{{ trans('site.edit', ['attr' => trans_choice('site.clients', 0)]) }} <i class="fas fa-edit"></i></button>
			@else
				<button type="button" class="btn btn-sm btn-primary disabled">{{ trans('site.edit', ['attr' => trans_choice('site.clients', 0)]) }} <i class="fas fa-edit"></i></button>
			@endcan
		</div>

		<div class="pr-1 mb-3 mb-xl-0">
			@can('client_list')
				<a href="{{ route('admin.clients.index') }}" class="btn btn-sm btn-success">{{ trans('site.all_attr', ['attr' => trans_choice('site.clients', 1)]) }} <i class="fas fa-long-arrow-alt-left"></i></a>
			@else
				<button type="button" class="btn btn-sm btn-success disabled">{{ trans('site.all_attr', ['attr' => trans_choice('site.clients', 1)]) }} <i class="fas fa-long-arrow-alt-left"></i></button>
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
										<i class="fas fa-4x fa-user"></i>
									</div>
									<div class="media-body">
										<h5>{{ $client->name }} {!! $client->statusWithLabel() !!}</h5>
										<p class="small text-muted mb-1">{{ trans('site.nationality') }}: {{ $client->nationality }}</p>
										<p class="small text-muted mb-1">{{ trans('site.mobile') }}: <a href="{{ whatsappLink($client->mobile, 'مرحبا: '.$client->name) }}">{{ $client->mobile }}</a></p>
									</div>
								</div>
							</div>
							<div class="main-contact-info-body p-4 ps">
								<div class="media-list pb-0">
									<div class="media">
										<div class="media-body">
											<div>
												<label>{{ trans('site.email') }}</label> <span class="tx-medium">{{ $client->email }}</span>
											</div>
										</div>
									</div>
									<div class="media">
										<div class="media-body">
											<div>
												<label>{{ trans('site.id_number') }}</label> <span class="tx-medium">{{ $client->id_number }}</span>
											</div>
										</div>
									</div>
									<div class="media">
										<div class="media-body">
											<div>
												<label>{{ trans('site.address') }}</label> <span class="tx-medium">{{ $client->address }}</span>
											</div>
										</div>
									</div>
									<div class="media">
										<div class="media-body">
											<div>
												<label>{{ trans('site.notes') }}</label> <span class="tx-medium">{{ $client->notes }}</span>
											</div>
										</div>
									</div>
								</div>
							<div class="ps__rail-x" style="left: 0px; top: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 824px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
						</div>

					</div>
					<div class="col-lg-9">
						<div class="row row-sm">
							<div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
								<div class="card bg-primary-gradient text-white ">
									<div class="card-body">
										<div class="row">
											<div class="col-9">
												<div class="mt-0 text-right">
													<span class="text-white">{{ trans('site.total') }}</span>
													<h2 class="text-white mb-0">{{ $client->clientAccounts->sum('debit') }}</h2>
												</div>
											</div>
											<div class="col-3">
												<div class="icon1 mt-2 text-center">
													<i class="fe fe-dollar-sign tx-40"></i>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
								<div class="card bg-danger-gradient text-white">
									<div class="card-body">
										<div class="row">
											<div class="col-9">
												<div class="mt-0 text-right">
													<span class="text-white">{{ trans('site.paid') }}</span>
													<h2 class="text-white mb-0">{{ $client->clientAccounts->sum('credit') }}</h2>
												</div>
											</div>
											<div class="col-3">
												<div class="icon1 mt-2 text-center">
													<i class="fe fe-corner-left-up tx-40"></i>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
								<div class="card bg-success-gradient text-white">
									<div class="card-body">
										<div class="row">
											<div class="col-9">
												<div class="mt-0 text-right">
													<span class="text-white">{{ trans('site.remaining_amount') }}</span>
													<h2 class="text-white mb-0">{{ $client->clientAccounts->sum('debit') - $client->clientAccounts->sum('credit') }}</h2>
												</div>
											</div>
											<div class="col-3">
												<div class="icon1 mt-2 text-center">
													<i class="fe fe-corner-left-down tx-40"></i>
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
								@canany(['lawsuite_list', 'consultation_list'])
									<div class="tabs-menu ">
										<!-- Tabs -->
										<ul class="nav nav-tabs profile navtab-custom panel-tabs">
											@can('lawsuite_list')
												<li class="active">
													<a href="#lawsuites" data-toggle="tab" aria-expanded="true"> <span class="visible-xs"><i class="las la-gavel tx-16 mr-1"></i></span> <span class="hidden-xs">{{ trans('site.all_attr', ['attr' => trans_choice('site.lawsuites', 1) ]) }}</span> </a>
												</li>
											@endcan

											@can('consultation_list')
												<li class="{{ auth()->user()->cannot('lawsuite_list') ? 'active' : ''}}">
													<a href="#consultations" data-toggle="tab" aria-expanded="true"> <span class="visible-xs"><i class="las la-question tx-16 mr-1"></i></span> <span class="hidden-xs">{{ trans('site.all_attr', ['attr' => trans_choice('site.consultations', 1) ]) }}</span> </a>
												</li>
											@endcan
										</ul>
									</div>
									<div class="tab-content border-left border-bottom border-right border-top-0 p-4">
										@can('lawsuite_list')
											<div class="tab-pane active" id="lawsuites">
												<div aria-multiselectable="true" class="accordion" id="accordion" role="tablist">
													<table id="example" class="table key-buttons dt-responsive text-md-nowrap" style="width:100%">
														<thead>
															<tr>
																<th class="border-bottom-0">{{ trans('site.lawsuite_file_number') }}</th>
																<th class="border-bottom-0">{{ trans_choice('site.courts', 0) }}</th>
																<th class="border-bottom-0">{{ trans('site.amount_attr', ['attr' => trans_choice('site.contracts', 0)]) }}</th>
																<th class="border-bottom-0">{{ trans('site.contract_amount_including_tax') }}</th>
																<th class="border-bottom-0">{{ trans('site.paid') }}</th>
																<th class="border-bottom-0">{{ trans('site.remaining') }}</th>
																<th class="border-bottom-0">{{ trans('site.actions') }}</th>
															</tr>
														</thead>
														<tbody>
															@foreach ($client->lawsuites as $lawsuite)
															<tr>
																<td><a href="{{ auth()->user()->can('lawsuite_show') ? route('admin.lawsuites.show', $lawsuite) : 'javascript:;' }}">{{ $lawsuite->case_number }}</a><br><span class="badge badge-secondary" style="background-color: {{ $lawsuite->lawsuitCase->color }}">{!! $lawsuite->lawsuitCase->trashed() ? '<span class="text-decoration-line-through text-white">'.$lawsuite->lawsuitCase->name.'</span>' : $lawsuite->lawsuitCase->name !!}</span></td>

																<td>{{ $lawsuite->court->name }}
                                                                    @if ($lawsuite->caseType)
                                                                        <p class="small text-muted mb-1">{{ removebeginninLetters(trans_choice('site.categories', 0), 2) .' '. trans_choice('site.lawsuites', 0).': ' }}{!! $lawsuite->caseType->trashed() ? '<span class="text-decoration-line-through text-muted">'.$lawsuite->caseType->name.'</span>' : $lawsuite->caseType->name !!}</p>
                                                                    @endif
																	<p class="small text-muted mb-1">{{removebeginninLetters(trans_choice('site.stages', 0), 2) .' '. trans('site.litigation').': ' }}{!! $lawsuite->caseStage->trashed() ? '<span class="text-decoration-line-through text-muted">'.$lawsuite->caseStage->name.'</span>' : $lawsuite->caseStage->name !!}</p></td>
																<td>{{ $lawsuite->contract_amount }}
																	<p class="small text-muted mb-1">{{ trans('site.amount_attr', ['attr' => trans('site.vat')]).': '. ($lawsuite->vat / 100) * $lawsuite->contract_amount }}</p>
																</td>
																<td>{{ $lawsuite->total_amount }}</td>
																<td>{{ $lawsuite->clientAccounts->sum('credit') }}</td>
																<td>{{ $lawsuite->total_amount - $lawsuite->clientAccounts->sum('credit') }}</td>
																<td>
																	<div class="btn-group">
																		@can('lawsuite_show')
																			<a href="{{ route('admin.lawsuites.show', $lawsuite) }}" class="btn btn-sm btn-primary"><i class="las la-eye"></i></a>
																		@else
																			<button type="button" class="btn btn-sm btn-primary disabled"><i class="las la-eye"></i></</button>
																		@endcan

																		@can('lawsuite_showContract')
																			<a href="{{ route('admin.show.contract', $lawsuite) }}" target="_blank" class="btn btn-sm btn-success"><i class="fas fa-file-contract"></i></a>
																		@else
																			<button type="button" class="btn btn-sm btn-success disabled"><i class="fas fa-file-contract"></i></</button>
																		@endcan

																		@can('lawsuite_edit')
																			<a href="{{ route('admin.lawsuites.edit', $lawsuite) }}" class="btn btn-sm btn-info"><i class="las la-pen"></i></a>
																		@else
																			<button type="button" class="btn btn-sm btn-info disabled"><i class="las la-pen"></i></</button>
																		@endcan

																		@can('lawsuite_delete')
																			<button type="button" class="btn btn-sm btn-danger modal-effect"  data-effect="effect-slide-in-right" data-toggle="modal" data-target="#deleteItemModal"
																			data-url="{{ route('admin.lawsuites.destroy', $lawsuite) }}"
																			data-id="{{ $lawsuite->id }}"
																			data-delete_label="{{ trans('site.sure_delete_attr', ['attr' => $lawsuite->case_number]) }}"
																			data-modal_title="{{ trans('site.delete_attr', ['attr' => trans_choice('site.lawsuites', 0)]) }}"><i class="las la-trash"></i></button>
																		@else
																			<button type="button" class="btn btn-sm btn-danger disabled"><i class="las la-trash"></i></</button>
																		@endcan
																	</div>
																</td>
															</tr>
															@endforeach
														</tbody>
													</table>
												</div>
											</div>
										@endcan

										@can('consultation_list')
											<div class="tab-pane {{ auth()->user()->cannot('lawsuite_list') ? 'active' : ''}}" id="consultations">
												<div aria-multiselectable="true" class="accordion" id="accordion" role="tablist">
													<table id="example2" class="table key-buttons dt-responsive text-md-nowrap" style="width:100%">
														<thead>
															<tr>
																<th class="border-bottom-0">{{ trans('site.consultation_file_number') }}</th>
																<th class="border-bottom-0">{{ trans('site.date_attr', ['attr' => trans_choice('site.consultations', 0)]) }}</th>
																<th class="border-bottom-0">{{ trans('site.amount_attr', ['attr' => trans_choice('site.consultations', 0)]) }}</th>
																<th class="border-bottom-0">{{ trans('site.paid') }}</th>
																<th class="border-bottom-0">{{ trans('site.remaining') }}</th>
																<th class="border-bottom-0">{{ trans('site.created_at') }}</th>
																<th class="border-bottom-0">{{ trans('site.actions') }}</th>
															</tr>
														</thead>
														<tbody>
															@foreach ($client->consultations as $consultation)
															<tr>
																<td><a href="{{ auth()->user()->can('consultation_show') ? route('admin.consultations.show', $consultation) : 'javascript:;' }}">{{ $consultation->consultation_number }}</a></td>
																<td>{{ $consultation->contract_date }}</td>
																<td>{{ $consultation->total_amount }}</td>
																<td>{{ $consultation->clientAccounts->sum('credit') }}</td>
																<td>{{ $consultation->total_amount - $consultation->clientAccounts->sum('credit') }}</td>
																<td>{{ $consultation->created_at->translatedFormat('d M, Y') }}</td>
																<td>
																	<div class="btn-group">
																		@can('consultation_show')
																			<a href="{{ route('admin.consultations.show', $consultation) }}" class="btn btn-sm btn-primary"><i class="las la-eye"></i></a>
																		@else
																			<button type="button" class="btn btn-sm btn-primary disabled"><i class="las la-eye"></i></</button>
																		@endcan

																		@can('consultation_showContract')
																			<a href="{{ route('admin.show.consultation.contract', $consultation) }}" target="_blank" class="btn btn-sm btn-success"><i class="fas fa-file-contract"></i></a>
																		@else
																			<button type="button" class="btn btn-sm btn-success disabled"><i class="fas fa-file-contract"></i></</button>
																		@endcan

																		@can('consultation_edit')
																			<a href="{{ route('admin.consultations.edit', $consultation) }}" class="btn btn-sm btn-info"><i class="las la-pen"></i></a>
																		@else
																			<button type="button" class="btn btn-sm btn-info disabled"><i class="las las la-pen"></i></</button>
																		@endcan

																		@can('consultation_delete')
																			<button type="button" class="btn btn-sm btn-danger modal-effect"  data-effect="effect-slide-in-right" data-toggle="modal" data-target="#deleteItemModal"
																			data-url="{{ route('admin.consultations.destroy', $consultation) }}"
																			data-id="{{ $consultation->id }}"
																			data-delete_label="{{ trans('site.sure_delete_attr', ['attr' => $consultation->consultation_number]) }}"
																			data-modal_title="{{ trans('site.delete_attr', ['attr' => trans_choice('site.consultations', 0)]) }}"><i class="las la-trash"></i></button>
																		@else
																			<button type="button" class="btn btn-sm btn-danger disabled"><i class="las la-trash"></i></</button>
																		@endcan
																	</div>
																</td>
															</tr>
															@endforeach
														</tbody>
													</table>
												</div>
											</div>
										@endcan
									</div>
								@else
									<p class="mb-0">للاطلاع على كافة المعلومات حول القضايا والاستشارات راجع الادارة</p>
								@endcanany
							</div>
						</div>
					</div>
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->

		@canany(['client_create', 'client_edit'])
			@include('admin.clients.partials.modal')
		@endcanany

		@can('client_delete')
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
	<!--Internal  Datatable js -->

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

			var table = $('#example2').DataTable({
				"lengthChange": false,
				"iDisplayLength": 10,
				"buttons": [ 'copy', 'excel', 'colvis' ],
				"language": {
					"buttons": {
						"copy": 'نسخ',
						"excel": 'إكسل',
						"colvis": 'الاعمدة الظاهره',
						"copyTitle": 'نسخ إلى الحافظة',
						"copyKeys": 'اضغط على <i>ctrl</i> أو <i>\u2318</i> + <i>C</i> لنسخ بيانات الجدول إلى الحافظة الخاصة بك.<br><br> للإلغاء ، انقر فوق هذه الرسالة أو اضغط على Esc.',
						"copySuccess": {
							_: '%d صفوف منسوخة',
							1: '1 تم نسخ الخط'
						}
					},
					"sProcessing": "جارٍ التحميل...",
					"sLengthMenu": "أظهر _MENU_ مدخلات",
					"sZeroRecords": "لم يعثر على أية سجلات",
					"sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
					"sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
					"sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
					"sInfoPostFix": "",
					"searchPlaceholder": 'ابحث...',
					"sSearch": "",
					"sUrl": "",
					"oPaginate": {
						"sFirst": "الأول",
						"sPrevious": "السابق",
						"sNext": "التالي",
						"sLast": "الأخير"
					}
				}
			});
			table.buttons().container()
			.appendTo( '#example2_wrapper .col-md-6:eq(0)' );

			@canany(['client_create', 'client_edit'])
				// hide modal with effect
				$('#addClient').on('shown.bs.modal', function(event) {
					var button = $(event.relatedTarget), // Button that triggered the modal
					url 			= button.data('url'),
					method 			= button.data('method'),
					submit_btn 		= button.data('submit_btn'),
					modal_title 	= button.data('modal_title'),
					id				= button.data('id'),
					client_name		= button.data('client_name'),
					id_number		= button.data('id_number'),
					cr_number		= button.data('cr_number'),
					city		 	= button.data('city'),
					address		 	= button.data('address'),
					po_box		 	= button.data('po_box'),
					mobile		 	= button.data('mobile'),
					phone		 	= button.data('phone'),
					email		 	= button.data('email'),
					status		 	= button.data('status'),
					nationality		= button.data('nationality'),
					user_name		= button.data('user_name'),
					notes		 	= button.data('notes'),

					modal = $(this);
					modal.find('#client_name').focus();
					modal.find('.modal-content').find('form').attr('action', url)
					modal.find('.modal-title').text(modal_title)
					modal.find('input[name=_method]').val(method)
					modal.find('input[name=id]').val(id)
					modal.find('#client_name').val(client_name)
					modal.find('#id_number').val(id_number)
					modal.find('#cr_number').val(cr_number)
					modal.find('#city').val(city)
					modal.find('#address').val(address)
					modal.find('#po_box').val(po_box)
					modal.find('#mobile').val(mobile)
					modal.find('#phone').val(phone)
					modal.find('#email').val(email)
					modal.find('#status').val(status)
					modal.find('#nationality').val(nationality)
					modal.find('#user_name').val(user_name)
					modal.find('#notes').val(user_name)
					modal.find('.save-btn').text(submit_btn)

					if(submit_btn == "{{ trans('site.add') }}") {
						modal.find('.save-btn').removeClass('btn-primary btn-danger').addClass('btn-success');
					}
					if(submit_btn == "{{ trans('site.update') }}") {
						modal.find('.save-btn').removeClass('btn-success btn-danger').addClass('btn-primary');
					}
				});
			@endcanany

			@can('client_delete')
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
			@endcan
		});
	</script>
@endsection
