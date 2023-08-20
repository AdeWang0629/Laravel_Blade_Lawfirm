{{-- <h2 class="mb-0 tx-22 mb-1 mt-1">{{ auth()->user()->consultations->count() }}</h2> --}}
@extends('layouts.admin.master')

@section('title', trans('site.page_attr', ['attr' => trans_choice('site.clients', 0)]).': '.auth()->user()->name)

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
			width: 60px !important;
			height: 60px !important;
			line-height: 66px !important;
			padding: 0px !important;
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
	</style>
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
			<h4 class="content-title mb-0 my-auto">{!! trans('site.page_attr', ['attr' => trans_choice('site.clients', 0)]).': <span class="text-danger">'.auth()->user()->name.'</span>' !!}</h4>
		</div>
	</div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row row-sm">
					<div class="col-lg-12">
						<div class="row row-sm">
							<div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
								<div class="card ">
									<div class="card-body">
										<div class="counter-status d-flex md-mb-0">
											<div class="ml-auto">
												<h5 class="tx-13">{{ trans('site.counts_attr',['attr'=>trans_choice('site.lawsuites',1)]) }}</h5>
												<h2 class="mb-0 tx-22 mb-1 mt-1">{{ auth()->user()->lawsuites->count() }}</h2>
												<p class="text-muted mb-0 tx-11"></p>
											</div>
											<div class="counter-icon bg-dark-transparent">
												<i class="fas fa-gavel text-dark "></i>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
								<div class="card ">
									<div class="card-body">
										<div class="counter-status d-flex md-mb-0">
											<div class="ml-auto">
												<h5 class="tx-13">{{ trans('site.counts_attr',['attr'=>trans_choice('site.consultations',1)]) }}</h5>
												{{-- <h2 class="mb-0 tx-22 mb-1 mt-1">{{ auth()->user()->consultations->count() }}</h2> --}}
												<p class="text-muted mb-0 tx-11"></p>
											</div>
											<div class="counter-icon bg-warning-transparent">
												<i class="fas fa-gavel text-warning "></i>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
								<div class="card ">
									<div class="card-body">
										<div class="counter-status d-flex md-mb-0">
											<div class="ml-auto">
												<h5 class="tx-13">{{ trans('site.total') }}</h5>
												<h2 class="mb-0 tx-22 mb-1 mt-1">{{ currency_details(auth()->user()->clientAccounts->sum('debit')) }}</h2>
												<p class="text-muted mb-0 tx-11"></p>
											</div>
											<div class="counter-icon bg-primary-transparent">
												<i class="fas fa-dollar-sign text-primary"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						@include('layouts.admin._partials.errors')

						<div class="row row-sm">
							<div class="col-sm-3">
								<div class="row row-sm">
									<div class="col-sm-12 col-lg-12 col-md-12">
										<div class="card ">
											<div class="card-body">
												<div class="counter-status d-flex md-mb-0">
													<div class="ml-auto">
														<h5 class="tx-13">{{ trans('site.paid') }}</h5>
														<h2 class="mb-0 tx-22 mb-1 mt-1">{{ currency_details(auth()->user()->clientAccounts->sum('credit')) }}</h2>
														<p class="text-muted mb-0 tx-11"></p>
													</div>
													<div class="counter-icon bg-danger-transparent">
														<i class="fas fa-money-bill-alt text-danger"></i>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-12 col-lg-12 col-md-12">
										<div class="card ">
											<div class="card-body">
												<div class="counter-status d-flex md-mb-0">
													<div class="ml-auto">
														<h5 class="tx-13">{{ trans('site.remaining_amount') }}</h5>
														<h2 class="mb-0 tx-22 mb-1 mt-1">{{ currency_details(auth()->user()->clientAccounts->sum('debit') - auth()->user()->clientAccounts->sum('credit')) }}</h2>
														<p class="text-muted mb-0 tx-11"></p>
													</div>
													<div class="counter-icon bg-success-transparent">
														<i class="fas fa-money-check-alt text-success"></i>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-9">
								<div class="card">
									<div class="card-body">
										<div class="tabs-menu ">
											<!-- Tabs -->
											<ul class="nav nav-tabs profile navtab-custom panel-tabs">
												<li class="active">
													<a href="#lawsuites" data-toggle="tab" aria-expanded="true"> <span class="visible-xs"><i class="las la-user-circle tx-16 mr-1"></i></span> <span class="hidden-xs">{{ trans('site.all_attr', ['attr' =>trans_choice('site.lawsuites', 1) ]) }}</span> </a>
												</li>
												<li>
													<a href="#consultations" data-toggle="tab" aria-expanded="true"> <span class="visible-xs"><i class="las la-user-circle tx-16 mr-1"></i></span> <span class="hidden-xs">{{ trans('site.all_attr', ['attr' =>trans_choice('site.consultations', 1) ]) }}</span> </a>
												</li>
											</ul>
										</div>
										<div class="tab-content border-left border-bottom border-right border-top-0 p-4">
											<div class="tab-pane active" id="lawsuites">
												<div aria-multiselectable="true" class="accordion" id="accordion" role="tablist">
													<div class="table-responsive">
														<table class="table key-buttons text-md-nowrap">
															<thead>
																<tr>
																	<th class="border-bottom-0">{{ trans('site.lawsuite_file_number') }}</th>
																	<th class="border-bottom-0">{{ trans_choice('site.courts', 0) }}</th>
																	<th class="border-bottom-0">{{ removebeginninLetters(trans_choice('site.stages', 0), 2) .' '. trans('site.litigation') }}</th>
																	<th class="border-bottom-0">{{ trans('site.amount_attr', ['attr' => trans_choice('site.contracts', 0)]) }}</th>
																	<th class="border-bottom-0">{{ trans('site.paid') }}</th>
																	<th class="border-bottom-0">{{ trans('site.remaining') }}</th>
																	<th class="border-bottom-0">{{ trans('site.actions') }}</th>
																</tr>
															</thead>
															<tbody>
																@foreach (auth()->user()->lawsuites as $lawsuite)
																<tr>
																	<td><a href="{{ route('client.lawsuite', $lawsuite) }}">{{ $lawsuite->case_number }}</a></td>
																	<td>{{ $lawsuite->court->name }}</td>
																	<td>{!! $lawsuite->caseStage->trashed() ? '<span class="text-decoration-line-through text-muted">'.$lawsuite->caseStage->name.'</span>' : $lawsuite->caseStage->name !!}</td>
																	<td>{{ $lawsuite->total_amount }}</td>
																	<td>{{ $lawsuite->clientAccounts->sum('credit') }}</td>
																	<td>{{ $lawsuite->total_amount - $lawsuite->clientAccounts->sum('credit') }}</td>
																	<td>
																		<a href="{{ route('client.lawsuite', $lawsuite) }}" class="btn btn-sm btn-primary">عرض التفاصيل</a>
																	</td>
																</tr>
																@endforeach
															</tbody>
														</table>
													</div>
												</div>
											</div>
											<div class="tab-pane" id="consultations">
												<div aria-multiselectable="true" class="accordion" id="accordion" role="tablist">
													<div class="table-responsive">
														<table class="table key-buttons text-md-nowrap">
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
															{{-- <tbody>
																@foreach (auth()->user()->consultations as $consultation)
																<tr>
																	<td><a href="{{ route('client.consultation', $consultation) }}">{{ $consultation->consultation_number }}</a></td>
																	<td>{{ $consultation->contract_date }}</td>
																	<td>{{ $consultation->total_amount }}</td>
																	<td>{{ $consultation->clientAccounts->sum('credit') }}</td>
																	<td>{{ $consultation->total_amount - $consultation->clientAccounts->sum('credit') }}</td>
																	<td>{{ $consultation->created_at->translatedFormat('d M, Y') }}</td>
																	<td>
																		<a href="{{ route('client.consultation', $consultation) }}" class="btn btn-sm btn-primary">عرض التفاصيل</a>
																	</td>
																</tr>
																@endforeach
															</tbody> --}}
														</table>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->

@endsection
@section('js')
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
@endsection
