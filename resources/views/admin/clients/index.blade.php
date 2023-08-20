@extends('layouts.admin.master')

@section('title', trans_choice('site.clients', 1))

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
				<h4 class="content-title mb-0 my-auto">{{ trans('site.table') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans_choice('site.clients', 1) }}</span>
			</div>
		</div>
		@canany(['clientType_create', 'client_create'])
			<div class="d-flex my-xl-auto right-content">
                <div class="pr-1 mb-3 mb-xl-0">
                    @if ($trashed->count() > 0)
                        @can('client_delete')
                            <a class="btn btn-sm btn-danger" href="{{ route('admin.clients.trashed') }}"><i class="mdi mdi-delete-sweep"></i> {{ trans('site.trashes') }}</a>
                        @else
                            <button type="button" class="btn btn-sm btn-danger disabled"><i class="mdi mdi-delete-sweep"></i> {{ trans('site.trashes') }}</button>
                        @endcan
                    @endcan
                </div>

				<div class="pr-1 mb-3 mb-xl-0">
					@can('client_create')
						<button type="button" class="btn btn-sm btn-info modal-effect"  data-effect="effect-slide-in-right" data-toggle="modal" data-target="#addClient"
						data-url="{{ route('admin.clients.store') }}"
						data-submit_btn="{{ trans('site.add') }}"
						data-modal_title="{{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.clients', 0), 2)]) }}"
						data-method=""><i class="mdi mdi-plus"></i> {{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.clients', 0), 2)]) }}</button>
					@else
						<button type="button" class="btn btn-sm btn-info disabled"><i class="mdi mdi-plus"></i> {{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.clients', 0), 2)]) }}</button>
					@endcan
				</div>
				<div class="pr-1 mb-3 mb-xl-0">
					@can('clientType_create')
						<button type="button" class="btn btn-sm btn-success modal-effect"  data-effect="effect-slide-in-right" data-toggle="modal" data-target="#clientType"
						data-url="{{ route('admin.clients-types.store') }}"
						data-submit_btn="{{ trans('site.add') }}"
						data-label_name="{{ trans('site.name') }}"
						data-modal_title="{{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.categories', 0), 2)]) }}"
						data-method=""><i class="mdi mdi-plus"></i> {{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.categories', 0), 2)]) }}</button>
					@else
						<button type="button" class="btn btn-sm btn-success disabled"><i class="mdi mdi-plus"></i> {{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.categories', 0), 2)]) }}</button>
					@endcan
				</div>
			</div>
		@endcanany
	</div>
	<!-- breadcrumb -->
@endsection
@section('content')
	@canany(['client_list', 'client_create', 'client_edit', 'client_delete'])
				<!-- row opened -->
				<div class="row row-sm">
					<div class="col-xl-12">
						@include('layouts.admin._partials.errors')
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">{{ trans_choice('site.clients', 1) }}</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
								<p class="tx-12 tx-gray-500 mb-2">{{ trans('site.here_you_can',['attr' => trans_choice('site.clients', 1)]) }}...
									@can('client_create')
										<button type="button" class="btn btn-link btn-sm p-0 modal-effect"  data-effect="effect-slide-in-right" data-toggle="modal" data-target="#addClient"
										data-url="{{ route('admin.clients.store') }}"
										data-submit_btn="{{ trans('site.add') }}"
										data-modal_title="{{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.clients', 0), 2)]) }}"
										data-method=""> {{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.clients', 0), 2)]) }}</button>
									@endcan
								</p>
							</div>
							<div class="card-body">
								@can('client_list')
									<table id="example" class="table table-striped dt-responsive text-center mg-b-0 text-md-nowrap" style="width:100%">
										<thead>
											<tr>
												<th class="border-bottom-0">{{ trans('site.name') }}</th>
												<th class="border-bottom-0">{{ trans('site.user_name') }}</th>
												<th class="border-bottom-0">{{ trans('site.address') }}</th>
												<th class="border-bottom-0">{{ trans('site.cases_counts') }}</th>
												<th class="border-bottom-0">{{ trans('site.consultation_counts') }}</th>
												<th class="border-bottom-0">{{ trans('site.total') }}</th>
												<th class="border-bottom-0">{{ trans('site.paid') }}</th>
												<th class="border-bottom-0">{{ trans('site.remaining_amount') }}</th>
												<th class="border-bottom-0">{{ trans('site.actions') }}</th>
												<th class="border-bottom-0">{{ trans('site.created_at') }}</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($clients as $client)
											<tr>
												<td><a href="{{ (auth()->user()->can('client_show') ? route('admin.clients.show', $client->id) : 'javascript:;') }}">{{ $client->name }} <br> {!! $client->statusWithLabel() !!}</a>
													<p class="small text-muted">{{ trans('site.nationality') }}: {{ $client->nationality }}</p></td>
												<td>{{ $client->user_name }}
													<p class="small text-muted">{{ trans('site.mobile') }}: <a target="_blank" href="{{ whatsappLink($client->mobile, 'مرحبا: '.$client->name) }}">{{ $client->mobile }}</a></p>
												</td>
												<td>{{ $client->address }}</td>

												<td>{!! $client->lawsuites_count > 0 ?  "<a href='".(auth()->user()->can('lawsuite_list') ? route('admin.lawsuites.index', ['client' => $client->id]) : 'javascript:;')."'>". $client->lawsuites_count."</a>" : $client->lawsuites_count !!}
													<span class="d-block small text-warning font-weight-bold">{{ trans('site.total_amount_with_vat') }}</span>
													{{ $client->clientAccounts->whereNotNull('lawsuite_id')->sum('debit') }}
												</td>
												<td>{!! $client->consultations_count > 0 ?  "<a href='".(auth()->user()->can('consultation_list') ? route('admin.consultations.index', ['client' => $client->id]) : 'javascript:;')."'>". $client->consultations_count."</a>" : $client->consultations_count !!}
													<span class="d-block small text-warning font-weight-bold">{{ trans('site.total_amount_with_vat') }}</span>
													{{ $client->clientAccounts->whereNotNull('consultation_id')->sum('debit') }}
												</td>
												<td>{{ $client->clientAccounts->sum('debit') }}</td>
												<td>{{ $client->clientAccounts->sum('credit') }}</td>
												<td>{{ $client->clientAccounts->sum('debit') - $client->clientAccounts->sum('credit') }}</td>
												<td>
													<div class="btn-group" role="group">
														@can('client_show')
															<a class="btn btn-sm btn-info" href="{{ route('admin.clients.show', $client->id) }}"><i class="las la-eye"></i></a>
														@endcan

														@can('client_edit')
															<button type="button" class="btn btn-sm btn-success modal-effect"  data-effect="effect-slide-in-right" data-toggle="modal" data-target="#addClient"
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
															data-method="PUT"><i class="las la-pen"></i></button>
														@else
															<button type="button" class="btn btn-sm btn-success disabled"><i class="las la-pen"></i></button>
														@endcan

														@can('client_delete')
															<button type="button" class="btn btn-sm btn-danger modal-effect"  data-effect="effect-slide-in-right" data-toggle="modal" data-target="#deleteItemModal"
															data-url="{{ route('admin.clients.destroy', $client) }}"
															data-id="{{ $client->id }}"
															data-delete_label="{{ trans('site.sure_delete_attr', ['attr' => $client->name]) }}"
															data-modal_title="{{ trans('site.delete_attr', ['attr' => trans_choice('site.clients', 0)]) }}"><i class="las la-trash"></i></button>
														@else
															<button type="button" class="btn btn-sm btn-danger disabled"><i class="las la-trash"></i></button>
														@endcan
													</div>
												</td>
												<td>{{ $client->created_at->translatedFormat('d M, Y') }}</td>
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

		@canany(['clientType_create', 'clientType_edit'])
			@include('admin.clients-types.partials.modal')
		@endcanany

		@canany(['client_create', 'client_edit'])
			@include('admin.clients.partials.modal')
		@endcanany

		@can('client_delete')
			@include('admin._partials.delete_modal')
		@endcan
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
<!--Internal  Datatable js -->
<script>
	$(function() {
		'use strict'

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
	});
</script>
@endsection
