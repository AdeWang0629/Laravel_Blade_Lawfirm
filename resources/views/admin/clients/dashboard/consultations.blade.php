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
				<a href="{{ route('client.dashboard') }}" class="btn btn-sm btn-success">{{ trans('site.back_to_attr', ['attr' => trans_choice('site.home', 1)]) }} <i class="fas fa-long-arrow-alt-left"></i></a>
			</div>
		</div>
	</div>
	<!-- breadcrumb -->
@endsection
@section('content')
			<!-- row -->
			<div class="row row-sm">
				<div class="col-lg-3">
					<div class="card mg-b-20">
						<div class="card-body">
							<div class="pl-0">
								<div class="main-profile-overview">
									<div class="main-img-user text-center bg-danger-transparent text-danger">
										<i class="fas fa-5x fa-gavel"></i>
									</div>
									<div class="d-flex justify-content-between mg-b-20">
										<div>
											<h5 class="main-profile-name">{{ trans('site.consultation_file_number') }}: <span class="text-danger">{{ $consultation->consultation_number }}</span></h5>
										</div>
									</div>
									<p class="case-info">{{ removebeginninLetters(trans('site.subject'), 2) . ' ' . trans_choice('site.consultations', 0) }}: {{ $consultation->consultation_subject }}</p>
									<p class="text-danger case-info">{{ trans('site.date_attr', ['attr' => trans_choice('site.consultations', 0)]) }}: {{ $consultation->contract_date }}</p>
									</br>

									<h5 class="main-profile-name">{{ trans('site.info_attr', ['attr' => trans_choice('site.clients', 0)]) }}</h5>
									<p class="case-info">{{ trans('site.name_attr', ['attr'=> trans_choice('site.clients', 0)]) }}: {!! $consultation->client->trashed() ? '<span class="text-decoration-line-through text-muted">'.$consultation->client->name.'</span>' : $consultation->client->name !!}</p>
									<p class="case-info">
                                        @if ($consultation->client->trashed())
                                            <span class="text-decoration-line-through text-muted">
                                        @endif
                                            {{ trans('site.phone_attr', ['attr'=> trans_choice('site.clients', 0)]) }}: <a href="{{ whatsappLink($consultation->client->mobile, 'مرحبا: '.$consultation->client->name) }}">{{ $consultation->client->mobile }}</a>
                                        @if ($consultation->client->trashed())
                                            </span>
                                        @endif
                                    </p>
									<p class="case-info">{{ trans('site.email') }}: {{ $consultation->client->email }}</p>
									<p class="case-info">{{ trans('site.nationality_attr', ['attr'=> trans_choice('site.clients', 0)]) }}: {{ $consultation->client->nationality }}</p>
									<p class="case-info">{{ trans('site.address_attr', ['attr'=> trans_choice('site.clients', 0)]) }}: {{ $consultation->client->address }}</p>

									</br>
									<a href="{{ route('client.show.qr.consultation.contract', $consultation->base_encode) }}" target="_blank" class="btn btn-sm btn-success">{{ trans('site.print_contract') }}</a>
								</div><!-- main-profile-overview -->
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-9">
					<div class="row row-sm">
						<div class="col-sm-12 col-xl-3 col-lg-12 col-md-12">
							<div class="card ">
								<div class="card-body">
									<div class="counter-status d-flex md-mb-0">
										<div class="ml-auto">
											<h5 class="tx-13">{{ trans('site.consultation_fee') }}</h5>
											<h2 class="mb-0 tx-22 mb-1 mt-1">{{ $consultation->contract_amount }}</h2>
											<p class="text-muted mb-0 tx-11"></p>
										</div>
										<div class="counter-icon bg-primary-transparent">
											<i class="fas fa-dollar-sign text-primary"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-xl-3 col-lg-12 col-md-12">
							<div class="card ">
								<div class="card-body">
									<div class="counter-status d-flex md-mb-0">
										<div class="ml-auto">
											<h5 class="tx-13">{{ trans('site.consultation_including_tax') }}</h5>
											<h2 class="mb-0 tx-22 mb-1 mt-1">{{ $consultation->total_amount }}</h2>
											<p class="text-muted mb-0 tx-11"></p>
										</div>
										<div class="counter-icon bg-danger-transparent">
											<i class="fas fa-money-bill-alt text-danger"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-xl-3 col-lg-12 col-md-12">
							<div class="card ">
								<div class="card-body">
									<div class="counter-status d-flex md-mb-0">
										<div class="ml-auto">
											<h5 class="tx-13">{{ trans('site.paid') }}</h5>
											<h2 class="mb-0 tx-22 mb-1 mt-1">{{ $consultation->clientAccounts->sum('credit') }}</h2>
											<p class="text-muted mb-0 tx-11"></p>
										</div>
										<div class="counter-icon bg-success-transparent">
											<i class="fas fa-money-check-alt text-success"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-xl-3 col-lg-12 col-md-12">
							<div class="card ">
								<div class="card-body">
									<div class="counter-status d-flex md-mb-0">
										<div class="ml-auto">
											<h5 class="tx-13">{{ trans('site.remaining') }}</h5>
											<h2 class="mb-0 tx-22 mb-1 mt-1">{{ $consultation->total_amount - $consultation->clientAccounts->sum('credit') }}</h2>
											<p class="text-muted mb-0 tx-11"></p>
										</div>
										<div class="counter-icon bg-warning-transparent">
											<i class="far fa-money-bill-alt text-warning"></i>
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

							<h4 class="tx-15 text-uppercase mb-3 font-weight-bold">{{ trans_choice('site.payments', 1) }}</h4>

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
												<a href="{{ route('client.show.qr.receipt', $receipt->base_encode) }}" target="_blank" class="btn btn-sm btn-success"><i class="las la-file-pdf"></i></a>
											</div>
										</td>
									</tr>
									@endforeach

								</tbody>
							</table>
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
@endsection
