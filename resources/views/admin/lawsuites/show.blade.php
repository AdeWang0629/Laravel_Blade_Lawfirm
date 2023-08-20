@extends('layouts.admin.master')

@section('title', trans('site.show_attr', ['attr' => trans_choice('site.lawsuites', 0)]).': '.$lawsuite->case_number)

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
		.main-content-body .main-contact-info-header .main-img-user img {
			width: 70px !important;
			height: 70px !important;
		}
		.main-content-body .main-contact-info-header .main-img-user {
			width: 70px !important;
			height: 70px !important;
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
				<h4 class="content-title mb-0 my-auto">{{ trans('site.home') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('site.show_attr', ['attr' => trans_choice('site.lawsuites', 0)]).': '.$lawsuite->case_number }}</span>
			</div>
		</div>
		<div class="d-flex my-xl-auto right-content">
			<div class="pr-1 mb-3 mb-xl-0">
				@can('lawsuite_edit')
					<a href="{{ route('admin.lawsuites.edit', $lawsuite) }}" class="btn btn-sm btn-primary">{{ trans('site.edit', ['attr' => trans_choice('site.lawsuites', 0)]) }} <i class="fas fa-edit"></i></a>
				@else
					<button type="button" class="btn btn-sm btn-primary disabled">{{ trans('site.edit', ['attr' => trans_choice('site.lawsuites', 0)]) }} <i class="fas fa-edit"></i></button>
				@endcan
			</div>

			<div class="pr-1 mb-3 mb-xl-0">
				@can('lawsuite_list')
					<a href="{{ route('admin.lawsuites.index') }}" class="btn btn-sm btn-success">{{ trans('site.all_attr', ['attr' => trans_choice('site.lawsuites', 1)]) }} <i class="fas fa-long-arrow-alt-left"></i></a>
				@else
					<button type="button" class="btn btn-sm btn-success disabled">{{ trans('site.all_attr', ['attr' => trans_choice('site.lawsuites', 1)]) }} <i class="fas fa-long-arrow-alt-left"></i></button>
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
										<i class="fas fa-4x fa-gavel"></i>
									</div>
									<div class="media-body">
										<h5><span class="text-danger">{{ $lawsuite->case_number }}</span></h5>
										<p class="small text-muted mb-1"><span class="btn-sm text-white d-inline-block rounded" style="background: {{ $lawsuite->lawsuitCase->color }}">{!! $lawsuite->lawsuitCase->trashed() ? '<span class="text-decoration-line-through text-white">'.$lawsuite->lawsuitCase->name.'</span>' : $lawsuite->lawsuitCase->name !!}</span></p>
										<p class="small text-muted mb-1">{{ removebeginninLetters(trans('site.subject'), 2) . ' ' . trans_choice('site.lawsuites', 0) }}: {{ $lawsuite->lawsuite_subject }}</p>
										<p class="small text-muted mb-0">{{ removebeginninLetters(trans_choice('site.stages', 0), 2) .' '. trans('site.litigation') }}: {!! $lawsuite->caseStage->trashed() ? '<span class="text-decoration-line-through text-muted">'.$lawsuite->caseStage->name.'</span>' : $lawsuite->caseStage->name !!}</p>
									</div>
								</div>

								@can('lawsuite_showContract')
									<a href="{{ route('admin.show.contract', $lawsuite) }}" target="_blank" class="btn btn-sm btn-success d-block mt-2">{{ trans('site.print_contract') }}</a>
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
												<p class="case-info mb-1">{{ removebeginninLetters(trans_choice('site.categories', 0), 2) .' '. trans_choice('site.clients', 0) }}: {!! $lawsuite->clientType->trashed() ? '<span class="text-decoration-line-through text-muted">'.$lawsuite->clientType->name.'</span>' : $lawsuite->clientType->name !!}</p>
												<p class="case-info mb-1">{{ trans('site.name') }}: <a href="{{ (auth()->user()->can('client_show') ? route('admin.clients.show', $lawsuite->client_id) : 'javascript:;') }}">{!! $lawsuite->client->trashed() ? '<span class="text-decoration-line-through text-muted">'.$lawsuite->client->name.'</span>' : $lawsuite->client->name !!}</a></p>
												<p class="case-info mb-1">{{ trans('site.mobile') }}: <a href="{{ whatsappLink($lawsuite->client->mobile, 'مرحبا: '.$lawsuite->client->name) }}">{{ $lawsuite->client->mobile }}</a></p>
												<p class="case-info mb-1">{{ trans('site.email') }}: {{ $lawsuite->client->email }}</p>
												<p class="case-info mb-1">{{ trans('site.nationality') }}: {{ $lawsuite->client->nationality }}</p>
												<p class="case-info mb-1">{{ trans('site.address') }}: {{ $lawsuite->client->address }}</p>
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
													<span class="text-white">{{ trans('site.lawsuite_fee') }}</span>
													<h2 class="text-white mb-0">{{ $lawsuite->contract_amount }}</h2>

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
													<span class="text-white">{{ trans('site.lawsuite_including_tax') }}</span>
													<h2 class="text-white mb-0">{{ $lawsuite->total_amount }}</h2>

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
													<h2 class="text-white mb-0">{{ $lawsuite->clientAccounts->sum('credit') }}</h2>
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
													<h2 class="text-white mb-0">{{ $lawsuite->lawsuiteRemaining }}</h2>
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
								<div class="panel panel-primary tabs-style-1">
									<div class=" tab-menu-heading">
										<div class="tabs-menu1">
											<!-- Tabs -->
											<ul class="nav panel-tabs main-nav-line">
												<li class="nav-item">
													<a href="#caseopponents" class="nav-link active" data-toggle="tab" aria-expanded="true">{{ trans('site.info_attr', ['attr' => trans_choice('site.opponents', 1)]) }}</a>
												</li>

												@can('caseSession_show')
													<li class="nav-item">
														<a href="#caseSession" class="nav-link" data-toggle="tab" aria-expanded="true">{{ removebeginninLetters(trans_choice('site.sessions', 1), 2).' '.trans_choice('site.lawsuites',0) }}</a>
													</li>
												@endcan

												@can('receipt_list')
													<li class="nav-item">
														<a href="#payments" class="nav-link" data-toggle="tab" aria-expanded="false">{{ trans_choice('site.payments', 1) }}</a>
													</li>
												@endcan

												@can('document_list')
													<li class="nav-item">
														<a href="#documents" class="nav-link" data-toggle="tab" aria-expanded="false"> <span class="visible-xs">{{ removebeginninLetters(trans_choice('site.documents', 1), 2).' '.trans_choice('site.lawsuites',0) }}</a>
													</li>
												@endcan

												@can('lawsuitePaper_list')
													<li class="nav-item">
														<a href="#newsPaper" class="nav-link" data-toggle="tab" aria-expanded="false"> <span class="visible-xs">{{ removebeginninLetters(trans_choice('site.newspapers', 1), 2).' '.trans_choice('site.cases',0) }}</a>
													</li>
												@endcan

												@canany(['lawsuiteNumber_create', 'lawsuiteNumber_edit', 'lawsuiteNumber_delete'])
													<li class="nav-item">
														<a href="#lawsuitesNumber" class="nav-link" data-toggle="tab" aria-expanded="false"> <span class="visible-xs">{{ trans('site.numbers_attr', ['attr' => trans_choice('site.lawsuites', 0)]) }}</a>
													</li>
												@endcanany

												@can('lawsuite_judgmentShow')
													<li class="nav-item">
														<a href="#judgment" class="nav-link" data-toggle="tab" aria-expanded="false"> <span class="visible-xs">{{ removebeginninLetters(trans_choice('site.judgments', 0), 2).' '.trans_choice('site.lawsuites',0) }}</a>
													</li>
												@endcan
											</ul>
										</div>
									</div>
									<div class="panel-body tabs-menu-body main-content-body-right border-top-0 border">
										<div class="tab-content">
											<div class="tab-pane active" id="caseopponents">
												@if ($lawsuite->opponents->count() > 0)
													<table class="table table-striped mg-b-0 text-md-nowrap">
														<thead>
															<tr>
																<th>{{ trans('site.name', ['attr'=> trans_choice('site.opponents', 0)]) }}</th>
																<th>{{ trans('site.mobile', ['attr'=> trans_choice('site.opponents', 0)]) }}</th>
																<th>{{ trans_choice('site.stations', 0) }}</th>
																<th>{{ trans('site.city') }}</th>
																<th>{{ trans('site.address', ['attr'=> trans_choice('site.opponents', 0)]) }}</th>
																<th>{{ trans('site.lawyer_attr', ['attr'=> trans_choice('site.opponents', 0)]) }}</th>
																<th>{{ trans('site.lawyer_phone_attr', ['attr'=> trans_choice('site.opponents', 0)]) }}</th>
															</tr>
														</thead>
														<tbody>
															@foreach ($lawsuite->opponents as $opponent)
															<tr>
																<td>{{ $opponent->opponent_name }}</td>
																<td><a href="{{ whatsappLink($opponent->opponent_phone, 'مرحبا: '.$opponent->opponent_name) }}">{{ $opponent->opponent_phone }}</a></td>
																<td>{{ $opponent->opponent_section }}</td>
																<td>{{ $opponent->opponent_city }}</td>
																<td>{{ $opponent->opponent_address }}</td>
																<td>{{ $opponent->opponent_lawyer }}</td>
																<td><a href="{{ whatsappLink($opponent->opponent_lawyer_phone, 'مرحبا: '.$opponent->opponent_name) }}">{{ $opponent->opponent_lawyer_phone }}</a></td>
															</tr>
															@endforeach
														</tbody>
													</table>
												@else
													<div class="alert alert-warning" role="alert">{{ trans('site.no_attr_yet', ['attr' => removebeginninLetters(trans_choice('site.opponents', 1), 2)]) }}</div>
												@endif
											</div>

											@can('caseSession_show')
												<div class="tab-pane" id="caseSession">

													@can('caseSession_create')
														<button type="button" class="btn btn-sm btn-success mb-3 modal-effect"  data-effect="effect-slide-in-right" data-toggle="modal"
														data-lawsuite_id="{{ $lawsuite->id }}"
														data-court_id="{{ $lawsuite->court_id }}"
														data-target="#addCaseSession"><i class="mdi mdi-plus"></i> {{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.sessions', 0), 2)]) }}</button>
													@else
														<button type="button" class="btn btn-sm btn-success mb-3 disabled"><i class="mdi mdi-plus"></i> {{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.sessions', 0), 2)]) }}</button>
													@endcan

													<h4 class="tx-15 text-uppercase mb-3 font-weight-bold">{{ removebeginninLetters(trans_choice('site.sessions', 1), 2).' '.trans_choice('site.lawsuites',0) }}</h4>
													<div aria-multiselectable="true" class="accordion" id="accordion" role="tablist">
														@forelse ($lawsuite->caseSessions->sortByDesc('start') as $caseSession)
															<div class="card mb-0">
																<div class="card-header" id="heading-{{ $caseSession->id }}" role="tab">
																	<a aria-controls="collapse-{{ $caseSession->id }}" aria-expanded="true" data-toggle="collapse" href="#collapse-{{ $caseSession->id }}" class="font-weight-bold d-flex justify-content-between"><div class="my-auto"><i class="far fa-clock ml-1 text-danger"></i>{{ $loop->iteration }}- {{ $caseSession->title }}</div><div>{{ $caseSession->start->format('Y-m-d') }}</div></a>
																</div>
																<div aria-labelledby="heading-{{ $caseSession->id }}" class="collapse {{ $loop->first ? 'show' : '' }}" data-parent="#accordion" id="collapse-{{ $caseSession->id }}" role="tabpanel">
																	<div class="card-body">
																		<div class="d-flex justify-content-between">
																			<div class="my-auto">
																				<span class="text-danger">{{ trans('site.date_attr', ['attr' => trans_choice('site.sessions', 0)]) }}: {{ $caseSession->start->format('d-m-Y') }}</span> <span class="text-danger font-weight-bold">({{ trans_choice('site.courts', 0) }}: {{ $lawsuite->court->name }})</span>
																			</div>

																			<div class="btn-icon-list">
																				@can('caseSession_edit')
																					<a href="{{ route('admin.case-sessions.edit', $caseSession) }}" class="btn btn-success btn-icon rounded"><i class="fe fe-edit"></i></a>
																				@else
																					<button type="button" class="btn btn-success btn-icon rounded disabled"><i class="fe fe-edit"></i></button>
																				@endcan

																				@can('caseSession_show')
																					<a href="{{ route('admin.case-sessions.show', $caseSession) }}" class="btn btn-primary btn-icon rounded"><i class="fe fe-eye"></i></a>
																				@else
																					<button type="button" class="btn btn-primary btn-icon rounded disabled"><i class="fe fe-eye"></i></button>
																				@endcan

																				@can('caseSession_delete')
																					<button type="button" class="btn btn-danger btn-icon modal-effect"  data-effect="effect-slide-in-right" data-toggle="modal" data-target="#deleteItemModal"
																					data-url="{{ route('admin.case-sessions.destroy', $caseSession) }}"
																					data-id="{{ $caseSession->id }}"
																					data-delete_label="{{ trans('site.sure_delete_attr', ['attr' => $caseSession->title]) }}"
																					data-modal_title="{{ trans('site.delete_attr', ['attr' => trans('site.session')]) }}"><i class="fe fe-trash-2"></i></button>
																				@else
																					<button type="button" class="btn btn-danger btn-icon disabled"><i class="fe fe-trash-2"></i></button>
																				@endcan
																			</div>
																		</div>
																		<div class="border border-light rounded mt-2 p-2">
																			{!! $caseSession->session_details !!}
																		</div>
																	</div>
																</div>
															</div>
														@empty
															<div class="alert alert-warning" role="alert">{{ trans('site.no_attr_yet', ['attr' => removebeginninLetters(trans_choice('site.sessions', 1), 2)]) }}</div>
														@endforelse
													</div>
												</div>
											@endcan

											@can('receipt_list')
												<div class="tab-pane" id="payments">
													@can('receipt_create')
														<button type="button" class="btn btn-sm btn-success mb-3 modal-effect"  data-effect="effect-slide-in-right" data-toggle="modal" data-target="#addReceipts"
														data-url="{{ route('admin.receipts.store') }}"
														data-lawsuite_id="{{ $lawsuite->id }}"
														data-client_id="{{ $lawsuite->client_id }}"
														data-submit_btn="{{ trans('site.add') }}"
														data-modal_title="{{ trans('site.add_new', ['attr' => trans('site.receipt')]) }}"
														data-method=""><i class="mdi mdi-plus"></i> {{ trans('site.add_new', ['attr' => trans('site.receipt')]) }}</button>
													@else
														<button type="button" class="btn btn-sm btn-success mb-3 disabled"><i class="mdi mdi-plus"></i> {{ trans('site.add_new', ['attr' => trans('site.receipt')]) }}</button>
													@endcan

													<h4 class="tx-15 text-uppercase mb-3 font-weight-bold">{{ trans_choice('site.payments', 1) }}</h4>

													@if ($lawsuite->receipts->count() > 0)
														<table class="table table-striped mg-b-0 text-md-nowrap">
															<thead>
																<tr>
																	<th>{{ removebeginninLetters(trans('site.title'), 2) .' '. trans_choice('site.payments', 0) }}</th>
																	<th>{{ trans('site.amount_attr', ['attr' => trans_choice('site.payments', 0)]) }}</th>
																	<th>{{ trans('site.payment_way') }}</th>
																	<th>{{ trans('site.date_attr', ['attr' => trans_choice('site.payments', 0)]) }}</th>
																	<th>{{ trans('site.actions') }}</th>
																</tr>
															</thead>
															<tbody>
																@foreach ($lawsuite->receipts as $receipt)
																<tr>
																	<td>{{ $receipt->title }}</td>
																	<td>{{ $receipt->debit }}</td>
																	<td>{{ $receipt->payment_type }}</td>
																	<td>{{ $receipt->date }}</td>
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
																				data-lawsuite_id="{{ $lawsuite->id }}"
																				data-client_id="{{ $lawsuite->client_id }}"
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
												</div>
											@endcan

											@can('document_list')
												<div class="tab-pane" id="documents">
													@can('document_create')
														<button type="button" class="btn btn-sm btn-success mb-3 modal-effect"  data-effect="effect-slide-in-right" data-toggle="modal" data-target="#addDocuments"
														data-lawsuite_id="{{ $lawsuite->id }}"
														data-url="{{ route('admin.documents.store') }}"
														data-submit_btn="{{ trans('site.add') }}"
														data-modal_title="{{ trans('site.add_new', ['attr' => trans_choice('site.documents', 1)]) }}"><i class="mdi mdi-plus"></i> {{ trans('site.add_new', ['attr' => trans_choice('site.documents', 1)]) }}</button>
													@else
														<button type="button" class="btn btn-sm btn-success mb-3 disabled"><i class="mdi mdi-plus"></i> {{ trans('site.add_new', ['attr' => trans_choice('site.documents', 1)]) }}</button>
													@endcan

													<h4 class="tx-15 text-uppercase mb-3 font-weight-bold">{{ trans_choice('site.documents', 1) }}</h4>

													@if ($lawsuite->documents->count() > 0)
														<table class="table table-striped mg-b-0 text-md-nowrap">
															<thead>
																<tr>
																	<th class="border-bottom-0">#</th>
																	<th class="border-bottom-0">{{ trans('site.name_attr', ['attr' => trans_choice('site.documents', 0)]) }}</th>
																	<th class="border-bottom-0">{{ trans('site.created_at') }}</th>
																	<th class="border-bottom-0">{{ trans('site.actions') }}</th>
																</tr>
															</thead>
															<tbody>
																@foreach ($lawsuite->documents as $document)
																<tr>
																	<td>{{ $loop->iteration }}</td>
																	<td>{{ $document->file_name }}</td>
																	<td>{{ $document->created_at->translatedFormat('d M, Y') }}</td>
																	<td>
																		@can('document_show')
																			<a href="{{ route('admin.documents.show', $document) }}" class="btn btn-sm btn-success" target="_blank"><i class="las la-eye"></i></a>
																		@else
																			<button type="button" class="btn btn-sm btn-success disabled"><i class="las la-eye"></i></button>
																		@endcan

																		@can('document_downloadDocument')
																			<form action="{{ route('admin.download.document') }}" method="GET" class="d-inline-block">
																				<input type="hidden" name="lawsuite_case_number"
																					value="{{ $lawsuite->case_number }}">
																				<input type="hidden" name="file_name" value="{{ $document->file_name }}">
																				<button class="btn btn-warning btn-sm" type="submit"><i class="fa fa-download"></i></button>
																			</form>
																		@else
																			<button type="button" class="btn btn-warning btn-sm disabled"><i class="fa fa-download"></i></button>
																		@endcan

																		@can('document_delete')
																			<button type="button" class="btn btn-sm btn-danger modal-effect"  data-effect="effect-slide-in-right" data-toggle="modal" data-target="#deleteItemModal"
																			data-url="{{ route('admin.documents.destroy', $document) }}"
																			data-id="{{ $document->id }}"
																			data-delete_label="{{ trans('site.sure_delete_attr', ['attr' => $document->file_name]) }}"
																			data-modal_title="{{ trans('site.delete_attr', ['attr' => trans_choice('site.documents',0) ]) }}"><i class="las la-trash"></i></button>
																		@else
																			<button type="button" class="btn btn-sm btn-danger btn-sm disabled"><i class="las la-trash"></i></button>
																		@endcan
																	</td>
																</tr>
																@endforeach
															</tbody>
														</table>
													@else
														<div class="alert alert-warning" role="alert">{{ trans('site.no_attr_yet', ['attr' => removebeginninLetters(trans_choice('site.documents', 1), 2)]) }}</div>
													@endif
												</div>
											@endcan

											@can('lawsuitePaper_list')
												<div class="tab-pane" id="newsPaper">
													<div class="table-responsive">
														@can('lawsuitePaper_create')
															<button type="button" class="btn btn-sm btn-success mb-3 modal-effect"  data-effect="effect-slide-in-right" data-toggle="modal" data-target="#addLawsuitePaper"
															data-url="{{ route('admin.lawsuites-papers.store') }}"
															data-lawsuite_id="{{ $lawsuite->id }}"
															data-submit_btn="{{ trans('site.add') }}"
															data-modal_title="{{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.newspapers', 0), 2)]) }}"><i class="mdi mdi-plus"></i> {{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.newspapers', 0), 2)]) }}</button>
														@else
															<button type="button" class="btn btn-sm btn-success mb-3 disabled"><i class="mdi mdi-plus"></i> {{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.newspapers', 0), 2)]) }}</button>
														@endcan

														<h4 class="tx-15 text-uppercase mb-3 font-weight-bold">{{ removebeginninLetters(trans_choice('site.newspapers', 1), 2).' '.trans_choice('site.cases', 0) }}</h4>

														@if ($lawsuite->lawsuitPapers->count() > 0)
															<table class="table table-striped mg-b-0 text-md-nowrap">
																<thead>
																	<tr>
																		<th>#</th>
																		<th>{{ removebeginninLetters(trans('site.title'), 2) .' '. trans_choice('site.newspapers', 0) }}</th>
																		<th>{{ trans('site.date_attr', ['attr' => trans_choice('site.newspapers', 0)]) }}</th>
																		<th>{{ trans('site.created_at') }}</th>
																		<th>{{ trans('site.actions') }}</th>
																	</tr>
																</thead>
																<tbody>
																	@foreach ($lawsuite->lawsuitPapers as $lawsuitPaper)
																	<tr>
																		<th scope="row">{{ $loop->iteration }}</th>
																		<td>{{ $lawsuitPaper->title }}</td>
																		<td>{{ $lawsuitPaper->date->format('Y-m-d') }}</td>
																		<td>{{ $lawsuitPaper->created_at->format('Y-m-d') }}</td>
																		<td>
																			<div class="btn-group">
																				@can('lawsuitePaper_show')
																					<a href="{{ route('admin.lawsuites-papers.show', $lawsuitPaper) }}" target="_blank" class="btn btn-sm btn-success"><i class="las la-file-pdf"></i></a>
																				@else
																					<button type="button" class="btn btn-sm btn-success disabled"><i class="las la-file-pdf"></i></button>
																				@endcan

																				@can('lawsuitePaper_edit')
																					<button type="button" class="btn btn-sm btn-info modal-effect"  data-effect="effect-slide-in-right" data-toggle="modal" data-target="#addLawsuitePaper"
																					data-url="{{ route('admin.lawsuites-papers.update', $lawsuitPaper) }}"
																					data-id="{{ $lawsuitPaper->id }}"
																					data-lawsuite_id="{{ $lawsuite->id }}"
																					data-title="{{ $lawsuitPaper->title }}"
																					data-subject="{{ $lawsuitPaper->subject }}"
																					data-date="{{ $lawsuitPaper->date->format('Y-m-d') }}"
																					data-based_on_it="{{ $lawsuitPaper->based_on_it }}"
																					data-submit_btn="{{ trans('site.update') }}"
																					data-modal_title="{{ trans('site.update_attr', ['attr' => removebeginninLetters(trans_choice('site.newspapers', 0), 2)]) }}"
																					data-method="PUT"><i class="las la-pen"></i></button>
																				@else
																					<button type="button" class="btn btn-sm btn-info disabled"><i class="las la-pen"></i></button>
																				@endcan

																				@can('lawsuitePaper_delete')
																					<button type="button" class="btn btn-sm btn-danger modal-effect"  data-effect="effect-slide-in-right" data-toggle="modal" data-target="#deleteItemModal"
																					data-url="{{ route('admin.lawsuites-papers.destroy', $lawsuitPaper) }}"
																					data-id="{{ $lawsuitPaper->id }}"
																					data-delete_label="{{ trans('site.sure_delete_attr', ['attr' => $lawsuitPaper->title]) }}"
																					data-modal_title="{{ trans('site.delete_attr', ['attr' => trans_choice('site.newspapers',0)]) }}"><i class="las la-trash"></i></button>
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
															<div class="alert alert-warning" role="alert">{{ trans('site.no_attr_yet', ['attr' => removebeginninLetters(trans_choice('site.newspapers', 1), 2)]) }}</div>
														@endif
													</div>
												</div>
											@endcan

											@canany(['lawsuiteNumber_create', 'lawsuiteNumber_edit', 'lawsuiteNumber_delete'])
												<div class="tab-pane" id="lawsuitesNumber">
													@can('lawsuiteNumber_create')
														<button type="button" class="btn btn-sm btn-success mb-3 modal-effect"  data-effect="effect-slide-in-right" data-toggle="modal" data-target="#lawsuiteNumber"
														data-url="{{ route('admin.lawsuites-number.store') }}"
														data-lawsuite_id="{{ $lawsuite->id }}"
														data-submit_btn="{{ trans('site.add') }}"
														data-modal_title="{{ trans('site.add_new', ['attr' => trans('site.lawsuites_new_number')]) }}"><i class="mdi mdi-plus"></i> {{ trans('site.add_new', ['attr' => trans('site.lawsuites_new_number')]) }}</button>
													@else
														<button type="button" class="btn btn-sm btn-success mb-3 disabled"><i class="mdi mdi-plus"></i> {{ trans('site.add_new', ['attr' => trans('site.lawsuites_new_number')]) }}</button>
													@endcan

													<h4 class="tx-15 text-uppercase mb-3 font-weight-bold">{{ trans('site.lawsuite_numbers') }}</h4>

													@if ($lawsuite->lawsuitNumbers->count() > 0)
														<table class="table table-striped mg-b-0 text-md-nowrap">
															<thead>
																<tr>
																	<th>#</th>
																	<th>{{ trans('site.description') }}</th>
																	<th>{{ trans('site.lawsuite_number') }}</th>
																	<th>{{ trans('site.notes') }}</th>
																	<th>{{ trans('site.actions') }}</th>
																	<th>{{ trans('site.created_at') }}</th>
																</tr>
															</thead>
															<tbody>
																@foreach ($lawsuite->lawsuitNumbers as $lawsuitNumber)
																<tr>
																	<th scope="row">{{ $loop->iteration }}</th>
																	<td>{{ $lawsuitNumber->description }}</td>
																	<td>{{ $lawsuitNumber->number }}</td>
																	<td>{{ $lawsuitNumber->notes }}</td>
																	<td>
																		<div class="btn-group">
																			@can('lawsuiteNumber_edit')
																				<button type="button" class="btn btn-sm btn-info modal-effect"
																				data-target="#lawsuiteNumber"
																				data-url="{{ route('admin.lawsuites-number.update', $lawsuitNumber) }}"
																				data-submit_btn="{{ trans('site.update') }}"
																				data-modal_title="{{ trans('site.update_attr', ['attr' => trans('site.lawsuite_number')]) }}"
																				data-id="{{ $lawsuitNumber->id }}"
																				data-lawsuite_id="{{ $lawsuite->id }}"
																				data-description="{{ $lawsuitNumber->description }}"
																				data-number="{{ $lawsuitNumber->number }}"
																				data-notes="{{ $lawsuitNumber->notes }}"
																				data-effect="effect-slide-in-right" data-toggle="modal"
																				data-method="PUT"><i class="las la-pen"></i></button>
																			@else
																				<button type="button" class="btn btn-sm btn-info disabled"><i class="las la-pen"></i></button>
																			@endcan

																			@can('lawsuiteNumber_delete')
																				<button type="button" class="btn btn-sm btn-danger modal-effect"  data-effect="effect-slide-in-right" data-toggle="modal" data-target="#deleteItemModal"
																				data-url="{{ route('admin.lawsuites-number.destroy', $lawsuitNumber) }}"
																				data-id="{{ $lawsuitNumber->id }}"
																				data-delete_label="{{ trans('site.sure_delete_attr', ['attr' => $lawsuitNumber->description]) }}"
																				data-modal_title="{{ trans('site.delete_attr', ['attr' => trans('site.lawsuite_number')]) }}"><i class="las la-trash"></i></button>
																			@else
																				<button type="button" class="btn btn-sm btn-danger disabled"><i class="las la-trash"></i></button>
																			@endcan
																		</div>
																	</td>

																	<td>{{ $lawsuitNumber->created_at->format('Y-m-d') }}</td>
																</tr>
																@endforeach

															</tbody>
														</table>
													@else
														<div class="alert alert-warning" role="alert">{{ trans('site.no_attr_yet', ['attr' => removebeginninLetters(trans_choice('site.numbers', 1), 2)]) }}</div>
													@endif
												</div>
											@endcanany

											@can('lawsuite_judgmentShow')
												<div class="tab-pane" id="judgment">
													<form action="{{ route('admin.lawsuites.judgment.update',$lawsuite) }}" method="POST">
														@csrf
														@method('PUT')
														<div class="form-group">
															<label for="judgment">{{ trans_choice('site.judgments', 0) }}</label>
															<textarea name="judgment" class="form-control @error('judgment') is-invalid @enderror contract_textarea" name="judgment" id="judgment" placeholder="{{ trans_choice('site.judgments', 0) }}">{{ old('judgment', $lawsuite->judgment) }}</textarea>
															@error('judgment')
																<span class="invalid-feedback" role="alert">
																	<strong>{{ $message }}</strong>
																</span>
															@enderror
														</div>
														@can('lawsuite_judgmentUpdate')
															<button class="btn ripple btn-success" type="submit">{{ trans('site.save') }}</button>
														@else
															<button type="button" class="btn ripple btn-success disabled">{{ trans('site.save') }}</button>
														@endcan
													</form>
												</div>
											@endcan
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

		@can('caseSession_create')
			@include('admin.lawsuites.partials.add_session_modal')
		@endcan

		@canany(['lawsuiteNumber_create', 'lawsuiteNumber_edit'])
			@include('admin.lawsuites.partials.add_lawsuite_number')
		@endcanany

		@canany(['lawsuitePaper_create', 'lawsuitePaper_edit'])
			@include('admin.lawsuites.partials.add_lawsuite_paper')
		@endcanany

		@can('document_create')
			@include('admin.lawsuites.partials.add_documents')
		@endcan

		@canany(['receipt_create', 'receipt_edit'])
			@include('admin._partials.add_receipt_modal')
		@endcanany

		@canany(['caseSession_delete', 'receipt_delete', 'document_delete', 'lawsuitePaper_delete', 'lawsuiteNumber_delete'])
			@include('admin._partials.delete_modal')
		@endcanany
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

			@can('caseSession_create')
				// hide modal with effect
				$('#addCaseSession').on('shown.bs.modal', function(event) {
					var button = $(event.relatedTarget), // Button that triggered the modal
					bg_color = button.data('bg_color'),
					lawsuite_id 	= button.data('lawsuite_id'),
					court_id 	= button.data('court_id'),
					modal = $(this);
					modal.find('#title').focus();

					modal.find('input[name=lawsuite_id]').val(lawsuite_id)
					modal.find('input[name=court_id]').val(court_id)

					$('#bg_color').spectrum({
						allowEmpty:true,
						color: bg_color,
						preferredFormat: "rgba",
						change: function (color) {
							$(this).closest('col-lg').find('#bg_color').val(color.toHex());
						}
					});
				});
			@endcan

			@canany(['caseSession_delete', 'receipt_delete', 'document_delete', 'lawsuitePaper_delete', 'lawsuiteNumber_delete'])
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

			@canany(['lawsuiteNumber_create', 'lawsuiteNumber_edit'])
				//description number notes
				$('#lawsuiteNumber').on('shown.bs.modal', function(event) {
					var button = $(event.relatedTarget), // Button that triggered the modal
					url 			= button.data('url'),
					method 			= button.data('method'),
					submit_btn 		= button.data('submit_btn'),
					modal_title 	= button.data('modal_title'),
					lawsuite_id		= button.data('lawsuite_id'),
					id		 		= button.data('id'),
					description     = button.data('description'),
					number			= button.data('number'),
					notes			= button.data('notes'),

					modal = $(this);
					modal.find('#description').focus();
					modal.find('.modal-content').find('form').attr('action', url)
					modal.find('.modal-title').text(modal_title)

					modal.find('#description').val(description)
					modal.find('#number').val(number)
					modal.find('#notes').val(notes)
					modal.find('.save-btn').text(submit_btn)
					modal.find('input[name=lawsuite_id]').val(lawsuite_id)
					modal.find('input[name=_method]').val(method)
					modal.find('input[name=id]').val(id)

					if(submit_btn == "{{ trans('site.add') }}") {
						modal.find('.save-btn').removeClass('btn-primary btn-danger').addClass('btn-success');
					}
					if(submit_btn == "{{ trans('site.update') }}") {
						modal.find('.save-btn').removeClass('btn-success btn-danger').addClass('btn-primary');
					}
				});
			@endcanany

			@canany(['lawsuitePaper_create', 'lawsuitePaper_edit'])
				// hide modal with effect
				$('#addLawsuitePaper').on('shown.bs.modal', function(event) {
					var button = $(event.relatedTarget), // Button that triggered the modal
					url 			= button.data('url'),
					method 			= button.data('method'),
					submit_btn 		= button.data('submit_btn'),
					modal_title 	= button.data('modal_title'),
					id				= button.data('id'),
					lawsuite_id		= button.data('lawsuite_id'),
					title			= button.data('title'),
					subject			= button.data('subject'),
					date			= button.data('date'),
					based_on_it		= button.data('based_on_it'),
					modal = $(this);


					modal = $(this);
					modal.find('#title').focus();
					modal.find('.modal-content').find('form').attr('action', url)
					modal.find('.modal-title').text(modal_title)
					modal.find('input[name=lawsuite_id]').val(lawsuite_id)
					modal.find('input[name=_method]').val(method)
					modal.find('input[name=id]').val(id)
					modal.find('.save-btn').text(submit_btn)

					if(submit_btn == "{{ trans('site.add') }}") {
						modal.find('.save-btn').removeClass('btn-primary btn-danger').addClass('btn-success');
					}
					if(submit_btn == "{{ trans('site.update') }}") {
						modal.find('#title').val(title)
						modal.find('input[name=date]').val(date)
						tinymce.get("subject").setContent(subject);
						tinymce.get("based_on_it").setContent(based_on_it);
						modal.find('.save-btn').removeClass('btn-success btn-danger').addClass('btn-primary');
					}
				});
			@endcanany

			@canany(['document_create', 'document_edit'])
				// hide modal with effect
				$('#addDocuments').on('shown.bs.modal', function(event) {
					var button = $(event.relatedTarget), // Button that triggered the modal
					url 			= button.data('url'),
					submit_btn 		= button.data('submit_btn'),
					modal_title 	= button.data('modal_title'),
					lawsuite_id 	= button.data('lawsuite_id'),
					modal = $(this);

					modal.find('#title').focus();
					modal.find('.modal-content').find('form').attr('action', url)
					modal.find('.modal-title').text(modal_title)
					modal.find('input[name=lawsuite_id]').val(lawsuite_id)

					modal.find('.save-btn').text(submit_btn)

					if(submit_btn == "{{ trans('site.add') }}") {
						modal.find('.save-btn').removeClass('btn-primary btn-danger').addClass('btn-success');
					}
				});
			@endcanany

			@canany(['receipt_create', 'receipt_edit'])
				// hide modal with effect
				$('#addReceipts').on('shown.bs.modal', function(event) {
					var button = $(event.relatedTarget), // Button that triggered the modal
					url 			= button.data('url'),
					submit_btn 		= button.data('submit_btn'),
					modal_title 	= button.data('modal_title'),
					method 			= button.data('method'),
					lawsuite_id		= button.data('lawsuite_id'),
					client_id		= button.data('client_id'),
					id				= button.data('id'),
					title			= button.data('title'),
					debit			= button.data('debit'),
					date			= button.data('date'),
					payment_type	= button.data('payment_type'),
					note			= button.data('note'),
					modal = $(this);


					modal = $(this);
					modal.find('#title').focus();
					modal.find('.modal-content').find('form').attr('action', url)
					modal.find('.modal-title').text(modal_title)
					modal.find('input[name=_method]').val(method)
					modal.find('input[name=id]').val(id)
					modal.find('input[name=lawsuite_id]').val(lawsuite_id)
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

			tinymce.init({
				selector: 'textarea.contract_textarea', // change this according to your HTML
				language: 'ar',
				height : "400",
				directionality : 'rtl',
				plugins: 'lists',
				toolbar: [
					{ name: 'history', items: [ 'undo', 'redo' ] },
					{ name: 'styles', items: [ 'styles' ] },
					{ name: 'formatting', items: [ 'bold', 'italic' ] },
					{ name: 'alignment', items: [ 'alignleft', 'aligncenter', 'alignright', 'alignjustify' ] },
					{ name: 'indentation', items: [ 'outdent', 'indent' ] },
					{ name: 'lists', items: [ 'numlist', 'bullist' ] }
				],
			});
		});

		// Prevent Bootstrap dialog from blocking focusin
		$(document).on('focusin', function(e) {
			if ($(e.target).closest(".mce-window, .tox-tinymce, .tox-tinymce-aux, .moxman-window, .tam-assetmanager-root").length) {
				e.stopImmediatePropagation();
			}
		});
	</script>
@endsection
