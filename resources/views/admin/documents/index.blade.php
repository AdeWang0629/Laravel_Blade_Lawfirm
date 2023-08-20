@extends('layouts.admin.master')

@section('title', trans('site.all_attr', ['attr' => trans_choice('site.documents', 1)]))

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
				<h4 class="content-title mb-0 my-auto">{{ trans('site.table') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('site.all_attr', ['attr' => trans_choice('site.documents', 1)]) }}</span>
			</div>
		</div>
	</div>
	<!-- breadcrumb -->
@endsection
@section('content')
	@canany(['document_list','document_show','document_delete','document_downloadDocument'])
				<!-- row opened -->
				<div class="row row-sm">
					<div class="col-xl-12">
						@include('layouts.admin._partials.errors')
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">{{ trans_choice('site.documents', 1) }}</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
							</div>
							<div class="card-body">
								@can('document_list')
									<table id="example" class="table table-striped dt-responsive text-center mg-b-0 text-md-nowrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0">#</th>
                                                <th class="border-bottom-0">{{ trans('site.name_attr', ['attr' => trans_choice('site.documents', 0)]) }}</th>
                                                <th class="border-bottom-0">{{ trans('site.numbers_attr', ['attr' => trans_choice('site.lawsuites', 1)]) }}</th>
                                                <th class="border-bottom-0">{{ trans('site.created_at') }}</th>
                                                <th class="border-bottom-0">{{ trans('site.actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($documents as $document)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $document->file_name }}</td>
                                                <td><a href="{{ (auth()->user()->can('lawsuite_show') ? route('admin.lawsuites.show', $document->documentable_id) : 'javascript:;') }}">{{ $document->documentable->case_number }}</a><br><p class="small text-muted mb-0">{{ trans('site.name_attr', ['attr' => trans_choice('site.clients', 0)]) }}: <a href="{{ (auth()->user()->can('client_show') ? route('admin.clients.show', $document->documentable->client_id) : 'javascript:;') }}">{{ $document->documentable->client->name }}</a></p></td>
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
																value="{{ $document->documentable->case_number }}">
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

		@can('document_delete')
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
	$(function(e) {
		$(function() {
			'use strict'

			@can('document_delete')
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