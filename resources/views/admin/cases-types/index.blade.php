@extends('layouts.admin.master')

@section('title', removebeginninLetters(trans_choice('site.categories', 1), 2) .' '. trans_choice('site.lawsuites', 1))

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
				<h4 class="content-title mb-0 my-auto">{{ trans('site.table') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ removebeginninLetters(trans_choice('site.categories', 1), 2) .' '. trans_choice('site.lawsuites', 1) }}</span>
			</div>
		</div>

		<div class="d-flex my-xl-auto right-content">
            <div class="pr-1 mb-3 mb-xl-0">
                @if ($trashed->count() > 0)
                    @can('caseType_delete')
                        <a class="btn btn-sm btn-danger" href="{{ route('admin.case-types.trashed') }}"><i class="mdi mdi-delete-sweep"></i> {{ trans('site.trashes') }}</a>
                    @else
                        <button type="button" class="btn btn-sm btn-danger disabled"><i class="mdi mdi-delete-sweep"></i> {{ trans('site.trashes') }}</button>
                    @endcan
                @endcan
            </div>
			<div class="pr-1 mb-3 mb-xl-0">
				@can('caseType_create')
					<button type="button" class="btn btn-sm btn-success modal-effect"  data-effect="effect-slide-in-right" data-toggle="modal" data-target="#caseType"
					data-url="{{ route('admin.case-types.store') }}"
					data-submit_btn="{{ trans('site.add') }}"
					data-label_name="{{ trans('site.name_attr', ['attr' => trans_choice('site.categories', 0)]) }}"
					data-modal_title="{{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.categories', 0), 2)]) }}"
					data-method=""><i class="mdi mdi-plus"></i> {{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.categories', 0), 2)]) }}</button>
				@else
					<button type="button" class="btn btn-sm btn-success disabled"><i class="mdi mdi-plus"></i> {{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.categories', 0), 2)]) }}</button>
				@endcan
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
								<h4 class="card-title mg-b-0">{{ removebeginninLetters(trans_choice('site.categories', 1), 2) .' '. trans_choice('site.lawsuites', 1) }}</h4>
								<i class="mdi mdi-dots-horizontal text-gray"></i>
							</div>
							<p class="tx-12 tx-gray-500 mb-2">{{ trans('site.here_you_can',['attr' => removebeginninLetters(trans_choice('site.categories', 1), 2) .' '. trans_choice('site.lawsuites', 1)]) }}...
								@can('caseType_create')
									<button type="button" class="btn btn-link btn-sm p-0 modal-effect"  data-effect="effect-slide-in-right" data-toggle="modal" data-target="#caseType"
									data-url="{{ route('admin.case-types.store') }}"
									data-submit_btn="{{ trans('site.add') }}"
									data-label_name="{{ trans('site.name_attr', ['attr' => trans_choice('site.categories', 0)]) }}"
									data-modal_title="{{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.categories', 0), 2)]) }}"
									data-method=""> {{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.categories', 0), 2)]) }}</button>
								@endcan
							</p>
						</div>
						<div class="card-body">
							@can('caseType_list')
								<table id="example" class="table table-striped dt-responsive text-center mg-b-0 text-md-nowrap" style="width:100%">
									<thead>
										<tr>
											<th class="border-bottom-0">{{ trans('site.name_attr', ['attr' => trans_choice('site.categories', 0)]) }}</th>
											<th class="border-bottom-0">{{ trans('site.cases_counts') }}</th>
											<th class="border-bottom-0">{{ trans('site.actions') }}</th>
											<th class="border-bottom-0">{{ trans('site.created_at') }}</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($caseTypes as $caseType)
										<tr>
											<td>{{ $caseType->name }}</td>
											<td>{!! $caseType->lawsuites_count > 0 ?  "<a href='".(auth()->user()->can('lawsuite_list') ? route('admin.lawsuites.index', ['case-type' => $caseType->id]) : 'javascript:;')."'>". $caseType->lawsuites_count."</a>" : $caseType->lawsuites_count !!}</td>
											<td>
												@can('caseType_edit')
													<button type="button" class="btn btn-sm btn-info modal-effect"  data-effect="effect-slide-in-right" data-toggle="modal" data-target="#caseType"
													data-url="{{ route('admin.case-types.update', $caseType) }}"
													data-case_type_name="{{ $caseType->name }}"
													data-id="{{ $caseType->id }}"
													data-submit_btn="{{ trans('site.update') }}"
													data-label_name="{{ trans('site.name_attr', ['attr' => trans_choice('site.categories', 0)]) }}"
													data-modal_title="{{ trans('site.update_attr', ['attr' => trans_choice('site.categories', 0) .' ']) }}"
													data-method="PUT"><i class="las la-pen"></i></button>
												@else
													<button type="button" class="btn btn-sm btn-info disabled"><i class="las la-pen"></i></button>
												@endcan

												@can('caseType_delete')
													<button type="button" class="btn btn-sm btn-danger modal-effect"  data-effect="effect-slide-in-right" data-toggle="modal" data-target="#deleteItemModal"
													data-url="{{ route('admin.case-types.destroy', $caseType) }}"
													data-id="{{ $caseType->id }}"
													data-delete_label="{{ trans('site.sure_delete_attr', ['attr' => $caseType->name]) }}"
													data-modal_title="{{ trans('site.delete_attr', ['attr' => trans_choice('site.categories', 0)]) }}"><i class="las la-trash"></i></button>
												@else
													<button type="button" class="btn btn-sm btn-danger disabled"><i class="las la-pen"></i></button>
												@endcan

											</td>
											<td>{{ $caseType->created_at->translatedFormat('d M, Y') }}</td>
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

	@canany(['caseType_create', 'caseType_edit'])
		@include('admin.cases-types.partials.modal')
	@endcanany

	@can('caseType_delete')
		@include('admin._partials.delete_modal')
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
	$(function() {
		'use strict'

		@canany(['caseType_create', 'caseType_edit'])
			// hide modal with effect
			$('#caseType').on('shown.bs.modal', function(event) {
				var button = $(event.relatedTarget), // Button that triggered the modal
				url = button.data('url'),
				case_type_name = button.data('case_type_name'),
				method = button.data('method'),
				submit_btn = button.data('submit_btn'),
				modal_title = button.data('modal_title'),
				label_name = button.data('label_name'),
				id = button.data('id'),
				modal = $(this);

				modal.find('.modal-content').find('form').attr('action', url)
				modal.find('.modal-title').text(modal_title)
				modal.find('.label_name').text(label_name)
				modal.find('input[name=_method]').val(method)
				modal.find('input[name=id]').val(id)
				modal.find('#case_type_name').val(case_type_name)
				modal.find('.save-btn').text(submit_btn)
				modal.find('#case_type_name').focus();

				if(submit_btn == "{{ trans('site.add') }}") {
					modal.find('.save-btn').removeClass('btn-primary btn-danger').addClass('btn-success');
				}
				if(submit_btn == "{{ trans('site.update') }}") {
					modal.find('.save-btn').removeClass('btn-success btn-danger').addClass('btn-primary');
				}
			});
		@endcanany

		@can('caseType_delete')
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
</script>
@endsection

