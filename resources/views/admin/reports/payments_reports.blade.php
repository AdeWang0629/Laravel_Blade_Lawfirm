@extends('layouts.admin.master')

@section('title', removebeginninLetters(trans_choice('site.reports', 1), 2) .' '. trans_choice('site.expenses', 1))

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
                <h4 class="content-title mb-0 my-auto">{{ trans('site.table') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ removebeginninLetters(trans_choice('site.reports', 1), 2) .' '. trans_choice('site.expenses', 1) }}</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content"></div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
				<!-- row opened -->
				<div class="row row-sm">
					<div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">{{ removebeginninLetters(trans_choice('site.reports', 1), 2) .' '. trans_choice('site.expenses', 1) }}</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
							</div>

							<div class="card-body">
                                <form action="{{ route('admin.payments.reports') }}" method="GET">
                                    <div class="row">
                                        <div class="form-group col-lg">
                                            <label for="contract_amount">{{ trans('site.date_attr', ['attr' => trans('site.beginning')]) }}</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                                                    </div>
                                                </div><input class="form-control @error('start_date') is-invalid @enderror fc-datepicker" name="start_date" placeholder="MM/DD/YYYY" type="text" value="{{ old('start_date', request()->start_date ?? now()->format('Y-m-d')) }}">
                                                @error('start_date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-lg">
                                            <label for="contract_amount">{{ trans('site.date_attr', ['attr' => trans('site.end')]) }}</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                                                    </div>
                                                </div><input class="form-control @error('end_date') is-invalid @enderror fc-datepicker" name="end_date" placeholder="MM/DD/YYYY" type="text" value="{{ old('end_date',request()->end_date ?? now()->format('Y-m-d')) }}">
                                                @error('end_date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-lg">
                                            <label for="contract_amount">{{ trans('site.actions') }}</label>
                                            <div class="input-group">
                                                <button type="submit" class="btn btn-primary">{{ trans('site.search') }}</button>
                                                <a href="{{ request()->url() }}" class="btn btn-danger mr-2"><i class="fas fa-sync-alt"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <p class="case-info font-weight-bold">{{ trans('site.total_attr_by_date', ['attr' => trans_choice('site.expenses', 1)]) }}: <span class="text-danger">{{ $payments->sum('debit') }}</span></p>
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
                                            @canany(['payment_showReceipt', 'payment_edit', 'payment_delete'])
                                                <th class="border-bottom-0">{{ trans('site.actions') }}</th>
                                            @endcanany
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
                                            @canany(['payment_showReceipt', 'payment_edit', 'payment_delete'])
                                            <td>
                                                <div class="btn-group">
                                                    @can('payment_showReceipt')
                                                        <a href="{{ route('admin.get.payment.receipt', $payment) }}" target="_blank" class="btn btn-sm btn-success"><i class="las la-file-pdf"></i></a>
                                                    @endcan

                                                    @can('payment_edit')
														<button type="button" class="btn btn-sm btn-info modal-effect"  data-effect="effect-slide-in-right" data-toggle="modal" data-target="#addPayment"
														data-url="{{ route('admin.payments.update', $payment) }}"
                                                        data-id="{{ $payment->id }}"
                                                        data-receiver="{{ $payment->receiver }}"
                                                        data-expense_section_id="{{ $payment->expense_section_id }}"
                                                        data-branch_id="{{ $payment->branch_id }}"
                                                        data-debit="{{ $payment->debit }}"
                                                        data-date="{{ $payment->date }}"
                                                        data-payment_type="{{ $payment->payment_type }}"
                                                        data-note="{{ $payment->note }}"
														data-submit_btn="{{ trans('site.update') }}"
														data-modal_title="{{ trans('site.update_attr', ['attr' => trans('site.receipt')]) }}"
														data-method="PUT"><i class="las la-pen"></i></button>
													@endcan

                                                    @can('payment_delete')
                                                        <button type="button" class="btn btn-sm btn-danger modal-effect"  data-effect="effect-slide-in-right" data-toggle="modal" data-target="#deleteItemModal"
                                                        data-url="{{ route('admin.payments.destroy', $payment) }}"
                                                        data-id="{{ $payment->id }}"
                                                        data-delete_label="{{ trans('site.sure_delete_attr', ['attr' => trans_choice('site.expenses',0)]) }}"
                                                        data-modal_title="{{ trans('site.delete_attr', ['attr' => trans('site.receipt')]) }}"><i class="las la-trash"></i></button>
                                                    @endcan
                                                </div>
                                            </td>
                                            @endcanany
                                            <td>{{ $payment->created_at->format('Y-m-d') }}</td>
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

        @can('payment_edit')
            @include('admin.payments.partials.add_payment_modal')
        @endcan

        @can('payment_delete')
            @include('admin._partials.delete_modal')
        @endcan
@endsection
@section('js')
    <!-- Internal Select2.min js -->
    <script src="{{URL::asset('admin_assets/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{URL::asset('admin_assets/plugins/select2/js/i18n/ar.js')}}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{URL::asset('admin_assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
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

		$('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd',
            showOtherMonths: true,
            selectOtherMonths: true
        });


        @can('client_edit')
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
		@endcan

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


</script>
@endsection
