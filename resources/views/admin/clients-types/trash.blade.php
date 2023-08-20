@extends('layouts.admin.master')

@section('title', removebeginninLetters(trans_choice('site.trashes', 1), 2) .' '. removebeginninLetters(trans_choice('site.categories', 1), 2) .' '. trans_choice('site.clients', 1))

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
				<h4 class="content-title mb-0 my-auto">{{ trans('site.table') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ removebeginninLetters(trans_choice('site.trashes', 1), 2) .' '. removebeginninLetters(trans_choice('site.categories', 1), 2) .' '. trans_choice('site.clients', 1) }}</span>
			</div>
		</div>

		<div class="d-flex my-xl-auto right-content">
            <div class="pr-1 mb-3 mb-xl-0">
                @can('clientType_list')
                    <a href="{{ route('admin.clients-types.index') }}" class="btn btn-sm btn-success">{{ trans('site.all_attr', ['attr' =>  removebeginninLetters(trans_choice('site.categories', 1), 2) .' '. trans_choice('site.clients', 1)]) }} <i class="fas fa-long-arrow-alt-left"></i></a>
                @else
                    <button type="button" class="btn btn-sm btn-success disabled">{{ trans('site.all_attr', ['attr' =>  removebeginninLetters(trans_choice('site.categories', 1), 2) .' '. trans_choice('site.clients', 1)]) }} <i class="fas fa-long-arrow-alt-left"></i></button>
                @endcan
            </div>
        </div>
	</div>
	<!-- breadcrumb -->
@endsection
@section('content')
	@canany(['clientType_list', 'clientType_create', 'clientType_edit', 'clientType_delete', 'clientType_restore'])
				<!-- row opened -->
				<div class="row row-sm">
					<div class="col-xl-12">
						@include('layouts.admin._partials.errors')
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">{{ removebeginninLetters(trans_choice('site.trashes', 1), 2) .' '. removebeginninLetters(trans_choice('site.categories', 1), 2) .' '. trans_choice('site.clients', 1)}}</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
							</div>
							<div class="card-body">
								@can('clientType_list')
									<table id="example" class="table table-striped dt-responsive text-center mg-b-0 text-md-nowrap" style="width:100%">
										<thead>
											<tr>
												<th class="border-bottom-0">{{ trans('site.name_attr', ['attr' => trans_choice('site.categories', 0)]) }}</th>
												<th class="border-bottom-0">{{ trans('site.cases_counts') }}</th>
												<th class="border-bottom-0">{{ trans('site.actions') }}</th>
												<th class="border-bottom-0">{{ trans('site.deleted_at') }}</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($trashed as $clientType)
											<tr>
												<td>{{ $clientType->name }}</td>
												<td>{!! $clientType->lawsuites_count > 0 ?  "<a href='".(auth()->user()->can('lawsuite_list') ? route('admin.lawsuites.index', ['clientType' => $clientType->id]) : 'javascript:;')."'>". $clientType->lawsuites_count."</a>" : $clientType->lawsuites_count !!}</td>
												<td>
                                                    @can('clientType_delete')
                                                        <button type="button" class="btn btn-sm btn-danger modal-effect"  data-effect="effect-slide-in-right" data-toggle="modal" data-target="#deleteItemModal"
                                                        data-url="{{ route('admin.clients-types.force.delete', $clientType) }}"
                                                        data-id="{{ $clientType->id }}"
                                                        data-delete_label="{{ trans('site.sure_force_delete_attr', ['attr' => $clientType->name]) }}"
                                                        data-modal_title="{{ trans('site.delete_attr', ['attr' => trans_choice('site.categories', 0)]) }}"><i class="las la-trash"></i></button>
                                                    @else
                                                        <button type="button" class="btn btn-sm btn-danger disabled"><i class="las la-trash"></i></button>
                                                    @endcan

                                                    @can('clientType_restore')
                                                        <button type="button" class="btn btn-sm btn-success modal-effect"  data-effect="effect-slide-in-right" data-toggle="modal" data-target="#restoreItemModal"
                                                        data-url="{{ route('admin.clients-types.restore', $clientType) }}"
                                                        data-id="{{ $clientType->id }}"
                                                        data-restore_label="{{ trans('site.sure_restore_attr', ['attr' => $clientType->name]) }}"
                                                        data-modal_title="{{ trans('site.restore_attr', ['attr' => trans_choice('site.categories', 0)]) }}"><i class="las la-trash-restore"></i></button>
                                                    @else
                                                        <button type="button" class="btn btn-sm btn-success disabled"><i class="las la-trash-restore"></i></button>
                                                    @endcan

                                                </td>
												<td>{{ $clientType->deleted_at->translatedFormat('d M, Y') }}</td>
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
        @can('clientType_delete')
            @include('admin._partials.delete_modal')
        @endcan
        @can('clientType_restore')
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

		@can('clientType_delete')
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

		@can('clientType_restore')
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
