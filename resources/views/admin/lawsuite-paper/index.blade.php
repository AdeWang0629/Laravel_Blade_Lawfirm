@extends('layouts.admin.master')

@section('title', removebeginninLetters(trans_choice('site.newspapers', 1), 2).' '.trans_choice('site.cases',0))

@section('css')
	<!-- Internal Data table css -->
	<link href="{{URL::asset('admin_assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
	<link href="{{URL::asset('admin_assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
	<link href="{{URL::asset('admin_assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
	<link href="{{URL::asset('admin_assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
	<link href="{{URL::asset('admin_assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
	<link href="{{URL::asset('admin_assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
	<style>
		.ui-datepicker.ui-widget-content {
			z-index: 999999 !important;
		}
	</style>
@endsection
@section('page-header')
	<!-- breadcrumb -->
	<div class="breadcrumb-header justify-content-between">
		<div class="my-auto">
			<div class="d-flex">
				<h4 class="content-title mb-0 my-auto">{{ trans('site.table') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ removebeginninLetters(trans_choice('site.newspapers', 1), 2).' '.trans_choice('site.cases',0) }}</span>
			</div>
		</div>
		<div class="d-flex my-xl-auto right-content">
			<div class="pr-1 mb-3 mb-xl-0">
				@can('lawsuite_create')
					<a href="{{ route('admin.lawsuites.create') }}" class="btn btn-sm btn-success"><i class="mdi mdi-plus"></i> {{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.lawsuites', 0), 2)]) }}</a>
				@else
					<button type="button" class="btn btn-sm btn-success disabled"><i class="mdi mdi-plus"></i> {{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.lawsuites', 0), 2)]) }}</button>
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
									<h4 class="card-title mg-b-0">{{ removebeginninLetters(trans_choice('site.newspapers', 1), 2).' '.trans_choice('site.cases',0) }}</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
								<p class="tx-12 tx-gray-500 mb-2">{{ trans('site.here_you_can',['attr' => removebeginninLetters(trans_choice('site.newspapers', 1), 2).' '.trans_choice('site.cases',0)]) }}... </p>
							</div>
							<div class="card-body">
								@can('lawsuitePaper_list')
									<table id="example" class="table table-striped dt-responsive text-center mg-b-0 text-md-nowrap" style="width:100%">
										<thead>
											<tr>
												<th class="border-bottom-0">#</th>

												<th class="border-bottom-0">{{ trans('site.lawsuite_file_number').'/'. trans('site.name_attr', ['attr' => trans_choice('site.clients', 0)]) }}</th>

												<th class="border-bottom-0">{{ removebeginninLetters(trans('site.title'), 2) .' '. trans_choice('site.newspapers', 0) }}</th>
												<th class="border-bottom-0">{{ trans('site.date_attr', ['attr' => trans_choice('site.newspapers', 0)]) }}</th>
												<th class="border-bottom-0">{{ trans('site.created_at') }}</th>
												<th class="border-bottom-0">{{ trans('site.actions') }}</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($lawsuitePapers as $lawsuitPaper)
											<tr>
												<td>{{ $loop->iteration }}</td>
												<td><a href="{{ route('admin.lawsuites.show', $lawsuitPaper->lawsuite->id) }}">{{ $lawsuitPaper->lawsuite->case_number }}</a> <p class="small text-muted"><a href="{{ (auth()->user()->can('client_show') ? route('admin.clients.show', $lawsuitPaper->lawsuite->client->id) : 'javascript:;') }}">{!! $lawsuitPaper->lawsuite->client->trashed() ? '<span class="text-decoration-line-through text-muted">'.$lawsuitPaper->lawsuite->client->name.'</span>' : $lawsuitPaper->lawsuite->client->name !!}</a></p></td>
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
															data-lawsuite_id="{{ $lawsuitPaper->lawsuite->id }}"
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

		@canany(['lawsuitePaper_edit'])
			@include('admin.lawsuites.partials.add_lawsuite_paper')
		@endcanany

		@can('lawsuitePaper_delete')
			@include('admin._partials.delete_modal')
		@endcan

@endsection
@section('js')<!-- Internal Data tables -->
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

		@canany(['lawsuitePaper_edit'])
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

					modal.find('#title').val(title)
					modal.find('input[name=date]').val(date)
					modal.find('input[name=lawsuite_id]').val(lawsuite_id)
					modal.find('input[name=_method]').val(method)
					modal.find('input[name=id]').val(id)

					modal.find('.save-btn').text(submit_btn)

					if(submit_btn == "{{ trans('site.add') }}") {
						modal.find('.save-btn').removeClass('btn-primary btn-danger').addClass('btn-success');
					}
					if(submit_btn == "{{ trans('site.update') }}") {
						tinymce.get("subject").setContent(subject);
						tinymce.get("based_on_it").setContent(based_on_it);
						modal.find('.save-btn').removeClass('btn-success btn-danger').addClass('btn-primary');
					}
				});
			@endcanany

		@can('lawsuitePaper_delete')
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
