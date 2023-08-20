@extends('layouts.admin.master')

@section('title', trans_choice('site.sessions', 1))

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
				<h4 class="content-title mb-0 my-auto">{{ trans('site.table') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans_choice('site.sessions', 1) }}</span>
			</div>
		</div>
		@can('lawsuite_create')
			<div class="d-flex my-xl-auto right-content">
				<div class="pr-1 mb-3 mb-xl-0">
					<a href="{{ route('admin.lawsuites.create') }}" class="btn btn-sm btn-success"><i class="mdi mdi-plus"></i> {{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.lawsuites', 0), 2)]) }}</a>
				</div>
			</div>
		@else
			<button type="button" class="btn btn-sm btn-success disabled"><i class="mdi mdi-plus"></i> {{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.lawsuites', 0), 2)]) }}</button>
		@endcan
	</div>
	<!-- breadcrumb -->
@endsection
@section('content')
	@can('caseSession_show')
				<!-- row opened -->
				<div class="row row-sm">
					<div class="col-xl-12">
						@include('layouts.admin._partials.errors')
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">{{ trans_choice('site.sessions', 1) }}</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
								<p class="tx-12 tx-gray-500 mb-2">{{ trans('site.here_you_can',['attr' => trans_choice('site.sessions', 1)]) }}... </p>
							</div>
							<div class="card-body">
								<table id="example" class="table table-striped dt-responsive text-center mg-b-0 text-md-nowrap" style="width:100%">
									<thead>
										<tr>
											<th class="border-bottom-0">{{ trans('site.lawsuite_file_number') }}</th>
											<th class="border-bottom-0">{{ removebeginninLetters(trans('site.title'), 2) .' '. trans_choice('site.sessions',0) }}</th>
											<th class="border-bottom-0">{{ trans('site.date_attr', ['attr' => trans_choice('site.sessions', 0)]) }}</th>
											<th class="border-bottom-0">{{ trans_choice('site.courts', 0) }}</th>
											<th class="border-bottom-0">{{ trans('site.actions') }}</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($caseSessions as $caseSession)
										<tr>
											<td><a href="{{ auth()->user()->can('lawsuite_show') ? route('admin.lawsuites.show', $caseSession->lawsuite_id) : 'javascript:;' }}" class="text-danger">{{ $caseSession->lawsuite->case_number }}</a><br><p class="small text-muted mb-0">{{ trans('site.name_attr', ['attr' => trans_choice('site.clients', 0)]) }}: <a href="{{ auth()->user()->can('client_show') ? route('admin.clients.show', $caseSession->lawsuite->client_id) : 'javascript:;' }}">{!! $caseSession->lawsuite->client->trashed() ? '<span class="text-decoration-line-through text-muted">'.$caseSession->lawsuite->client->name.'</span>' : $caseSession->lawsuite->client->name !!}</a></p></td>
											<td><a href="{{ auth()->user()->can('caseSession_show') ? route('admin.case-sessions.show', $caseSession) : 'javascript:;' }}">{{ $caseSession->title }}</a></td>
											<td>{{ $caseSession->start->format('Y-m-d') }}</td>
											<td>{!! $caseSession->court->trashed() ? '<span class="text-decoration-line-through text-muted">'.$caseSession->court->name.'</span>' : $caseSession->court->name !!}</td>
											<td>
												@can('caseSession_edit')
													<a href="{{ route('admin.case-sessions.edit', $caseSession) }}" class="btn btn-sm btn-info"><i class="las la-pen"></i></a>
												@else
													<button type="button" class="btn btn-sm btn-info disabled"><i class="las la-pen"></i></button>
												@endcan

												@can('caseSession_delete')
													<button type="button" class="btn btn-sm btn-danger modal-effect"  data-effect="effect-slide-in-right" data-toggle="modal" data-target="#deleteItemModal"
													data-url="{{ route('admin.case-sessions.destroy', $caseSession) }}"
													data-id="{{ $caseSession->id }}"
													data-delete_label="{{ trans('site.sure_delete_attr', ['attr' => $caseSession->title]) }}"
													data-modal_title="{{ trans('site.delete_attr', ['attr' => trans_choice('site.sessions', 0)]) }}"><i class="las la-trash"></i></button>
												@else
													<button type="button" class="btn btn-sm btn-danger disabled"><i class="las la-trash"></i></button>
												@endcan
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->

		@can('caseSession_delete')
			@include('admin._partials.delete_modal')
		@endcan
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
	<script>
		$(function(e) {
			$(function() {
				'use strict'
				@can('caseSession_delete')
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
		});
	</script>
@endsection
