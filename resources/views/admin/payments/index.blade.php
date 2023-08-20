@extends('layouts.admin.master')

@section('title', trans_choice('site.expenses', 1))

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
				<h4 class="content-title mb-0 my-auto">{{ trans('site.table') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans_choice('site.expenses', 1) }}</span>
			</div>
		</div>

		<div class="d-flex my-xl-auto right-content">
			<div class="pr-1 mb-3 mb-xl-0">
				@can('payment_create')
					<button type="button" class="btn btn-sm btn-primary modal-effect"  data-effect="effect-slide-in-right" data-toggle="modal" data-target="#addPayment"
					data-url="{{ route('admin.payments.store') }}"
					data-submit_btn="{{ trans('site.add') }}"
					data-modal_title="{{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.expenses', 0), 2)]) }}"
					data-method=""><i class="mdi mdi-plus"></i> {{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.expenses', 0), 2)]) }}</button>
				@else
					<button type="button" class="btn btn-sm btn-primary disabled"><i class="mdi mdi-plus"></i> {{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.expenses', 0), 2)]) }}</button>
				@endcan
			</div>
		</div>
	</div>
	<!-- breadcrumb -->
@endsection
@section('content')
	@canany(['payment_list', 'payment_create', 'payment_edit', 'payment_delete'])
				<!-- row opened -->
				<div class="row row-sm">
					<div class="col-xl-12">
						@include('layouts.admin._partials.errors')
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">{{ trans_choice('site.expenses', 1) }}</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
								<p class="tx-12 tx-gray-500 mb-2">{{ trans('site.here_you_can',['attr' => trans_choice('site.expenses', 1)]) }}...
									@can('payment_create')
										<button type="button" class="btn btn-link btn-sm p-0 modal-effect"  data-effect="effect-slide-in-right" data-toggle="modal" data-target="#addPayment"
										data-url="{{ route('admin.payments.store') }}"
										data-submit_btn="{{ trans('site.add') }}"
										data-modal_title="{{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.expenses', 0), 2)]) }}"
										data-method="">{{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.expenses', 0), 2)]) }}</button>
									@endcan
								</p>
							</div>
							<div class="card-body">
								@can('payment_list')
									<table id="example" class="table table-striped dt-responsive text-center mg-b-0 text-md-nowrap" style="width:100%">
										<thead>
											<tr>
												<th class="border-bottom-0">#</th>
												<th class="border-bottom-0">{{ trans('site.receiver') }}</th>
												<th class="border-bottom-0">{{ trans_choice('site.sections', 0) }}</th>
												<th class="border-bottom-0">{{ trans_choice('site.branches', 0) }}</th>
												<th class="border-bottom-0">{{ trans('site.amount_attr', ['attr' => trans('site.paid')]) }}</th>
												<th class="border-bottom-0">{{ trans('site.date_attr', ['attr' => trans_choice('site.payments', 0)]) }}</th>
												<th class="border-bottom-0">{{ trans('site.thats_about') }}</th>
												<th class="border-bottom-0">{{ trans('site.actions') }}</th>
												<th class="border-bottom-0">{{ trans('site.created_at') }}</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($payments as $payment)
											<tr>
												<td>{{ $loop->iteration }}</td>
												<td>{{ $payment->receiver }}</td>
												<td>{!! $payment->expenseSection->trashed() ? '<span class="text-decoration-line-through text-muted">'.$payment->expenseSection->name.'</span>' : $payment->expenseSection->name !!}</td>
												<td>{!! $payment->branch->trashed() ? '<span class="text-decoration-line-through text-muted">'.$payment->branch->name.'</span>' : $payment->branch->name !!}</td>
												<td>{{ $payment->debit }}</td>
												<td>{{ $payment->date }}</td>
												<td>{{ $payment->note }}</td>
												<td>
													<div class="btn-group">
														@can('payment_showReceipt')
															<a href="{{ route('admin.get.payment.receipt', $payment) }}" target="_blank" class="btn btn-sm btn-success"><i class="las la-file-pdf"></i></a>
														@else
															<button type="button" class="btn btn-sm btn-success disabled"><i class="las la-file-pdf"></i></button>
														@endcan

														@can('payment_edit')
															<button type="button" class="btn btn-sm btn-info modal-effect" data-effect="effect-slide-in-right"  data-toggle="modal"
															data-target="#addPayment"
															data-url="{{ route('admin.payments.update', $payment) }}"
															data-submit_btn="{{ trans('site.update') }}"
															data-id="{{ $payment->id }}"
															data-receiver="{{ $payment->receiver }}"
															data-expense_section_id="{{ $payment->expense_section_id }}"
															data-branch_id="{{ $payment->branch_id }}"
															data-debit="{{ $payment->debit }}"
															data-date="{{ $payment->date }}"
															data-payment_type="{{ $payment->payment_type }}"
															data-note="{{ $payment->note }}"
															data-modal_title="{{ trans('site.update_attr', ['attr' => trans('site.receipt')]) }}"
															data-method="PUT"><i class="las la-pen"></i></button>
														@else
															<button type="button" class="btn btn-sm btn-info disabled"><i class="las la-pen"></i></button>
														@endcan

														@can('payment_delete')
															<button type="button" class="btn btn-sm btn-danger modal-effect"  data-effect="effect-slide-in-right" data-toggle="modal" data-target="#deleteItemModal"
															data-url="{{ route('admin.payments.destroy', $payment) }}"
															data-id="{{ $payment->id }}"
															data-delete_label="{{ trans('site.sure_delete_attr', ['attr' => trans_choice('site.expenses',0)]) }}"
															data-modal_title="{{ trans('site.delete_attr', ['attr' => trans('site.receipt')]) }}"><i class="las la-trash"></i></button>
														@else
															<button type="button" class="btn btn-sm btn-danger disabled"><i class="las la-trash"></i></button>
														@endcan
													</div>
												</td>
												<td>{{ $payment->created_at->format('Y-m-d') }}</td>
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

		@canany(['payment_create', 'payment_edit'])
			@include('admin.payments.partials.add_payment_modal')
		@endcanany

		@can('payment_delete')
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
<!-- Internal Select2.min js -->
<script src="{{URL::asset('admin_assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{URL::asset('admin_assets/plugins/select2/js/i18n/ar.js')}}"></script>
<!--Internal  Datepicker js -->
<script src="{{URL::asset('admin_assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<script>
	$(function(e) {
		$(function() {
			'use strict'

			$('.fc-datepicker').datepicker({
				dateFormat: 'yy-mm-dd',
				showOtherMonths: true,
				selectOtherMonths: true
			});

			@canany(['payment_create', 'payment_edit'])
				// hide modal with effect
				$('#addPayment').on('shown.bs.modal', function(event) {
					var button = $(event.relatedTarget), // Button that triggered the modal
					url = button.data('url'),
					id					= button.data('id'),
					receiver			= button.data('receiver'),
					expense_section_id	= button.data('expense_section_id'),
					branch_id			= button.data('branch_id'),
					debit				= button.data('debit'),
					date				= button.data('date'),
					payment_type		= button.data('payment_type'),
					note				= button.data('note'),
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
					modal.find('#receiver').val(receiver)
					modal.find('#expense_section_id').val(expense_section_id)
					modal.find('#branch_id').val(branch_id)
					modal.find('#debit').val(debit)
					modal.find('input[name=date]').val(date)
					modal.find('#payment_type').val(payment_type)
					modal.find('#note').val(note)
					modal.find('.save-btn').text(submit_btn)
					modal.find('#receiver').focus();

					if(submit_btn == "{{ trans('site.add') }}") {
						modal.find('.save-btn').removeClass('btn-primary btn-danger').addClass('btn-success');
					}
					if(submit_btn == "{{ trans('site.update') }}") {
						modal.find('.save-btn').removeClass('btn-success btn-danger').addClass('btn-primary');
					}

					$('.clients').select2({
						placeholder: "{{ trans('site.choose_attr', ['attr' => '']) }}",
						language: 'ar',
						dir: "rtl",
					});
				});
			@endcanany

			@can('payment_delete')
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
