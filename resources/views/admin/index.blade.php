@extends('layouts.admin.master')
@section('css')
<!--  Owl-carousel css-->
<link href="{{URL::asset('admin_assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
<!-- Maps css -->
<link href="{{URL::asset('admin_assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
	<!-- breadcrumb -->
	<div class="breadcrumb-header justify-content-between">
		<div class="left-content">
			<div>
				<h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">{{ trans('site.welcome_back') }} <span class="text-warning font-weight-bold">{{ auth()->user()->user_name }}</span></h2>
				@can('home')
					<p class="mg-b-0">{{ trans('site.here_are_some_quick_statistics') }}</p>
				@endcan
			</div>
		</div>
		@can('home')
			<div class="main-dashboard-header-right">
				<div>
					<label class="tx-13">
						<a href="{{ auth()->user()->can('lawsuite_list') ? route('admin.lawsuites.index') : 'javascript:;' }}" class="text-secondary">{{ trans('site.cases_counts') }}</a>
					</label>
					<h5><a href="{{ auth()->user()->can('lawsuite_list') ? route('admin.lawsuites.index') : 'javascript:;' }}" class="text-secondary">{{ $lawsuitesCount }}</a></h5>
				</div>
				<div>
					<label class="tx-13">
						<a href="{{ auth()->user()->can('consultation_list') ? route('admin.consultations.index') : 'javascript:;' }}" class="text-secondary">{{ trans('site.consultation_counts') }}</a>
					</label>
					<h5><a href="{{ auth()->user()->can('consultation_list') ? route('admin.consultations.index') : 'javascript:;' }}" class="text-secondary">{{ $consultationsCount }}</a></h5>
				</div>
			</div>
		@endcan
	</div>
	<!-- /breadcrumb -->
@endsection
@section('content')
			@can('home')
				<!-- row -->
				<div class="row row-sm">
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-primary-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">{{ removebeginninLetters(trans_choice('site.payments', 1), 2) .' '.trans_choice('site.lawsuites', 1) }}</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white">{{ currency_details($lawsuitesPayments) }}</h4>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-danger-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">{{ removebeginninLetters(trans_choice('site.payments', 1), 2) .' '.trans_choice('site.consultations', 1) }}</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white">{{ currency_details($consultationPayments) }}</h4>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-success-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">{{ trans('site.counts_attr', ['attr' => trans_choice('site.clients', 1)]) }}</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white">{{ $clientsCount }}</h4>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-warning-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">{{ trans('site.counts_attr', ['attr' => trans_choice('site.sessions', 1)]) }}</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white">{{ $caseSessionCount }}</h4>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- row closed -->
			@endcan
			<!-- row opened -->
			<div class="row row-sm row-deck">
				@can('receipt_list')
					<div class="col-md-12 col-lg-4 col-xl-4">
						<div class="card card-dashboard-eight pb-2">
							<h6 class="card-title">{{ trans('site.last_of_attr', ['attr' => trans_choice('site.payments', 1) ]) }}</h6><span class="d-block mg-b-10 text-muted tx-12">{{ trans('site.here_you_will_find_the_last_attr', ['attr' =>  trans_choice('site.payments', 1)]) }}</span>

							<div class="list-group">
								@foreach ($receipts as $receipt)
									<div class="list-group-item border-top-0">
										<p>{{ $receipt->title }} ({{ removebeginninLetters($receipt->lawsuite_id != null ? trans_choice('site.lawsuites', 0) : trans_choice('site.consultations', 0), 2) }})</p><span>{{ currency_details($receipt->debit) }}</span>
									</div>
								@endforeach
							</div>
						</div>
					</div>
				@endcan
				@can('lawsuite_list')
					<div class="col-md-12 col-lg-8 col-xl-8">
						<div class="card card-table-two">
							<div class="d-flex justify-content-between">
								<h4 class="card-title mb-1">{{ trans('site.last_of_attr', ['attr' => trans_choice('site.lawsuites', 1) ]) }}</h4>
								<i class="mdi mdi-dots-horizontal text-gray"></i>
							</div>
							<span class="tx-12 tx-muted mb-3 ">{{ trans('site.here_you_will_find_the_last_attr', ['attr' =>  trans_choice('site.lawsuites', 1)]) }}</span>
							<div class="table-responsive country-table">
								<table class="table table-striped table-bordered mb-0 text-sm-nowrap text-lg-nowrap text-xl-nowrap">
									<thead>
										<tr>
											<th class="wd-lg-25p">{{ trans('site.lawsuite_file_number') }}</th>
											<th class="wd-lg-25p tx-right">{{ trans('site.name_attr', ['attr' => trans_choice('site.clients', 0)]) }}</th>
											<th class="wd-lg-25p tx-right">{{ removebeginninLetters(trans_choice('site.categories', 0), 2) .' '. trans_choice('site.lawsuites', 0) }}</th>
											<th class="wd-lg-25p tx-right">{{ trans_choice('site.courts', 0) }}</th>
										</tr>
									</thead>
									<tbody>
										@foreach($lawsuites as $lawsuite)
											<tr>
												<td><a href="{{ auth()->user()->can('lawsuite_show') ? route('admin.lawsuites.show', $lawsuite) : 'javascript:;' }}">{{ $lawsuite->case_number }}</a></td>
												<td class="tx-right tx-medium tx-inverse"><a href="{{ auth()->user()->can('client_show') ? route('admin.clients.show', $lawsuite->client_id) : 'javascript:;' }}">{!! $lawsuite->client->trashed() ? '<span class="text-decoration-line-through text-muted">'.$lawsuite->client->name.'</span>' : $lawsuite->client->name !!}</a></td>
												<td class="tx-right tx-medium tx-inverse">{!! $lawsuite->caseType->trashed() ? '<span class="text-decoration-line-through text-muted">'.$lawsuite->caseType->name.'</span>' : $lawsuite->caseType->name !!}</td>
												<td class="tx-right tx-medium tx-inverse">{{ $lawsuite->court->name }}</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				@endcan
			</div>
			<!-- /row -->
		</div>
	</div>
	<!-- Container closed -->
@endsection
@section('js')
@endsection
