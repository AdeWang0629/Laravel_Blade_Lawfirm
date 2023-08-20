@extends('layouts.admin.master')

@if (request()->type == 'lawsuites')
	@section('title', trans('site.all_attr', ['attr' => removebeginninLetters(trans_choice('site.payments', 1), 2) .' '.trans_choice('site.lawsuites', 1)  ]))
@elseif(request()->type == 'consultations')
	@section('title', trans('site.all_attr', ['attr' => removebeginninLetters(trans_choice('site.payments', 1), 2) .' '.trans_choice('site.consultations', 1)  ]))
@else
	@section('title', trans('site.all_attr', ['attr' => trans_choice('site.payments', 1)  ]))
@endif

@section('css')
	<!-- Internal Data table css -->
	<link href="{{URL::asset('admin_assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
	<link href="{{URL::asset('admin_assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
	<link href="{{URL::asset('admin_assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
	<link href="{{URL::asset('admin_assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
	<link href="{{URL::asset('admin_assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
	<link href="{{URL::asset('admin_assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection

@section('page-header')
	<!-- breadcrumb -->
	<div class="breadcrumb-header justify-content-between">
		<div class="my-auto">
			<div class="d-flex">
				<h4 class="content-title mb-0 my-auto">{{ trans('site.table') }}</h4>
				<span class="text-muted mt-1 tx-13 mr-2 mb-0">/ 
					@if (request()->type == 'lawsuites')
						{{ trans('site.all_attr', ['attr' => removebeginninLetters(trans_choice('site.payments', 1), 2) .' '.trans_choice('site.lawsuites', 1)  ]) }}
					@elseif(request()->type == 'consultations')
						{{ trans('site.all_attr', ['attr' => removebeginninLetters(trans_choice('site.payments', 1), 2) .' '.trans_choice('site.consultations', 1)  ]) }}
					@else
						{{ trans('site.all_attr', ['attr' => trans_choice('site.payments', 1)  ]) }}
					@endif
				</span>
			</div>
		</div>
		<div class="d-flex my-xl-auto right-content">
			<div class="pr-1 mb-3 mb-xl-0">
				@if (request()->type == 'lawsuites')
					@can('lawsuite_create')
						<a href="{{ route('admin.lawsuites.create') }}" class="btn btn-sm btn-success"><i class="mdi mdi-plus"></i> {{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.lawsuites', 0), 2)]) }}</a>
					@else
						<button type="button" class="btn btn-sm btn-success disabled"><i class="mdi mdi-plus"></i> {{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.lawsuites', 0), 2)]) }}</button>
					@endcan
				@elseif(request()->type == 'consultations')
					@can('consultations_create')
						<a href="{{ route('admin.consultations.create') }}" class="btn btn-sm btn-success"><i class="mdi mdi-plus"></i> {{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.consultations', 0), 2)]) }}</a>
					@else
						<button type="button" class="btn btn-sm btn-success disabled"><i class="mdi mdi-plus"></i> {{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.consultations', 0), 2)]) }}</button>
					@endcan
				@else
					@can('lawsuite_create')
						<a href="{{ route('admin.lawsuites.create') }}" class="btn btn-sm btn-primary"><i class="mdi mdi-plus"></i> {{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.lawsuites', 0), 2)]) }}</a>
					@else
						<button type="button" class="btn btn-sm btn-primary disabled"><i class="mdi mdi-plus"></i> {{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.lawsuites', 0), 2)]) }}</button>
					@endcan

					@can('consultation_create')
						<a href="{{ route('admin.consultations.create') }}" class="btn btn-sm btn-success"><i class="mdi mdi-plus"></i> {{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.consultations', 0), 2)]) }}</a>
					@else
						<button type="button" class="btn btn-sm btn-success disabled"><i class="mdi mdi-plus"></i> {{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.consultations', 0), 2)]) }}</button>
					@endcan
				@endif
			</div>
		</div>
	</div>
	<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row opened -->
				<div class="row row-sm">
					<div class="col-xl-12">
						@include('layouts.admin._partials.errors')
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">
										@if (request()->type == 'lawsuites')
											{{ trans('site.all_attr', ['attr' => removebeginninLetters(trans_choice('site.payments', 1), 2) .' '.trans_choice('site.lawsuites', 1)  ]) }}
										@elseif(request()->type == 'consultations')
											{{ trans('site.all_attr', ['attr' => removebeginninLetters(trans_choice('site.payments', 1), 2) .' '.trans_choice('site.consultations', 1)  ]) }}
										@else
											{{ trans('site.all_attr', ['attr' => trans_choice('site.payments', 1)  ]) }}
										@endif
									</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
							</div>
							<div class="card-body">
								@can('receipt_list')
									<table id="example" class="table table-striped dt-responsive text-center mg-b-0 text-md-nowrap" style="width:100%">
										<thead>
											<tr>
												<th class="border-bottom-0">
													@if (request()->type == 'lawsuites')
														{{ trans('site.lawsuite_file_number') }}
													@elseif(request()->type == 'consultations')
														{{ trans('site.consultation_file_number') }}
													@else
														{{ trans('site.file_number') }}
													@endif
												</th>
												<th class="border-bottom-0">{{ trans('site.name_attr', ['attr' => trans_choice('site.clients', 0)]) }}</th>
												<th>{{ removebeginninLetters(trans('site.title'), 2) .' '. trans_choice('site.payments', 0) }}</th>
												<th>{{ trans('site.amount_attr', ['attr' => trans_choice('site.payments', 0)]) }}</th>
												<th>{{ trans('site.payment_way') }}</th>
												<th>{{ trans('site.date_attr', ['attr' => trans_choice('site.payments', 0)]) }}</th>
												<th class="border-bottom-0">{{ trans('site.actions') }}</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($receipts as $receipt)
											<tr>                                                
												<td>
													@if ($receipt->lawsuite_id != null)
														<a href="{{ (auth()->user()->can('lawsuite_show') ? route('admin.lawsuites.show', $receipt->lawsuite_id) : 'javascript:;') }}">{{ $receipt->lawsuite->case_number}}</a>
													@else
														<a href="{{ (auth()->user()->can('consultation_show') ? route('admin.consultations.show', $receipt->consultation_id) : 'javascript:;') }}">{{ $receipt->consultation->consultation_number}}</a>				
													@endif
												</td>
												<td><a href="{{ (auth()->user()->can('client_show') ? route('admin.clients.show', $receipt->client_id) : 'javascript:;') }}">{{ $receipt->client->name }}</a></td>
												<td>{{ $receipt->title }}</td>
												<td>{{ $receipt->debit }}</td>
												<td>{{ $receipt->payment_type }}</td>
												<td>{{ $receipt->date }}</td>
												<td>
													@can('receipt_showReceipt')
														<a href="{{ route('admin.show.receipt', $receipt) }}" target="_blank" class="btn btn-sm btn-success"><i class="las la-file-pdf"></i></a>
													@else
														<button type="button" class="btn btn-sm btn-success disabled"><i class="las la-file-pdf"></i></button>
													@endcan
												</td>
											</tr>
											@endforeach
										</tbody>
									</table>
								@else
									<div class="alert alert-warning" role="alert">{{ trans('site.user_does_not_have_the_right_permissions') }}</div>
								@endcan
							</div>
						</div>
					</div>
				</div>
				<!-- /row -->
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
	<!--Internal  Datatable js -->
@endsection