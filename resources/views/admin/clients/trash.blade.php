@extends('layouts.admin.master')

@section('title', removebeginninLetters(trans_choice('site.trashes', 1), 2) .' '. trans_choice('site.clients', 1))

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
				<h4 class="content-title mb-0 my-auto">{{ trans('site.table') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ removebeginninLetters(trans_choice('site.trashes', 1), 2) .' '. trans_choice('site.clients', 1) }}</span>
			</div>
		</div>
		<div class="d-flex my-xl-auto right-content">
            <div class="pr-1 mb-3 mb-xl-0">
                @can('clientType_list')
                    <a href="{{ route('admin.clients.index') }}" class="btn btn-sm btn-success">{{ trans('site.all_attr', ['attr' =>  trans_choice('site.clients', 1)]) }} <i class="fas fa-long-arrow-alt-left"></i></a>
                @else
                    <button type="button" class="btn btn-sm btn-success disabled">{{ trans('site.all_attr', ['attr' =>  trans_choice('site.clients', 1)]) }} <i class="fas fa-long-arrow-alt-left"></i></button>
                @endcan
            </div>
        </div>
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
									<h4 class="card-title mg-b-0">{{ removebeginninLetters(trans_choice('site.trashes', 1), 2) .' '. trans_choice('site.clients', 1) }}</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
							</div>
							<div class="card-body">
								@can('client_list')
									<table id="example" class="table table-striped dt-responsive text-center mg-b-0 text-md-nowrap" style="width:100%">
										<thead>
											<tr>
												<th class="border-bottom-0">{{ trans('site.name') }}</th>
												<th class="border-bottom-0">{{ trans('site.user_name') }}</th>
												<th class="border-bottom-0">{{ trans('site.cases_counts') }}</th>
												<th class="border-bottom-0">{{ trans('site.consultation_counts') }}</th>
												<th class="border-bottom-0">{{ trans('site.total') }}</th>
												<th class="border-bottom-0">{{ trans('site.paid') }}</th>
												<th class="border-bottom-0">{{ trans('site.remaining_amount') }}</th>
												<th class="border-bottom-0">{{ trans('site.actions') }}</th>
												<th class="border-bottom-0">{{ trans('site.deleted_at') }}</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($trashed as $client)
											<tr>
												<td><a href="{{ (auth()->user()->can('client_show') ? route('admin.clients.show', $client->id) : 'javascript:;') }}">{{ $client->name }}</a></td>
												<td>{{ $client->user_name }}
													<p class="small text-muted">{{ trans('site.mobile') }}: <a target="_blank" href="{{ whatsappLink($client->mobile, 'مرحبا: '.$client->name) }}">{{ $client->mobile }}</a></p>
												</td>
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
														@can('client_delete')
															<button type="button" class="btn btn-sm btn-danger modal-effect"  data-effect="effect-slide-in-right" data-toggle="modal" data-target="#deleteItemModal"
															data-url="{{ route('admin.clients.force.delete', $client) }}"
															data-id="{{ $client->id }}"
															data-delete_label="{{ trans('site.sure_force_delete_attr', ['attr' => $client->name]) }}"
															data-modal_title="{{ trans('site.delete_attr', ['attr' => trans_choice('site.clients', 0)]) }}"><i class="las la-trash"></i></button>
														@else
															<button type="button" class="btn btn-sm btn-danger disabled"><i class="las la-trash"></i></button>
														@endcan

                                                        @can('client_restore')
                                                            <button type="button" class="btn btn-sm btn-success modal-effect"  data-effect="effect-slide-in-right" data-toggle="modal" data-target="#restoreItemModal"
                                                            data-url="{{ route('admin.clients.restore', $client) }}"
                                                            data-id="{{ $client->id }}"
                                                            data-restore_label="{{ trans('site.sure_restore_attr', ['attr' => $client->name]) }}"
                                                            data-modal_title="{{ trans('site.restore_attr', ['attr' => trans_choice('site.categories', 0)]) }}"><i class="las la-trash-restore"></i></button>
                                                        @else
                                                            <button type="button" class="btn btn-sm btn-success disabled"><i class="las la-trash-restore"></i></button>
                                                        @endcan
													</div>
												</td>
												<td>{{ $client->deleted_at->translatedFormat('d M, Y') }}</td>
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

		@can('client_delete')
			@include('admin._partials.delete_modal')
		@endcan

        @can('client_restore')
            @include('admin._partials.restore_modal')
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

		@can('client_restore')
            // hide modal with effect
            $('#restoreItemModal').on('shown.bs.modal', function(event) {
                var button 			= $(event.relatedTarget), // Button that triggered the modal
                    url 			= button.data('url'),
                    modal_title 	= button.data('modal_title'),
                    id 				= button.data('id'),
                    restore_label	= button.data('restore_label'),

                modal = $(this);
                modal.find('.modal-content').find('form').attr('action', url)
                modal.find('.modal-title').text(modal_title)
                modal.find('.restore_label').text(restore_label)
                modal.find('input[name=id]').val(id)
            });
        @endcan
	});
</script>
@endsection
