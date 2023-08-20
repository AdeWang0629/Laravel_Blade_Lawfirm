@extends('layouts.admin.master')

@section('title', removebeginninLetters(trans_choice('site.reports', 1), 2) .' '. trans_choice('site.clients', 1))

@section('css')
	<!-- Internal Data table css -->
	<link href="{{URL::asset('admin_assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
	<link href="{{URL::asset('admin_assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
	<link href="{{URL::asset('admin_assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
	<link href="{{URL::asset('admin_assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
	<link href="{{URL::asset('admin_assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
	<!--Internal  Datetimepicker-slider css -->
	<link href="{{URL::asset('admin_assets/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css')}}" rel="stylesheet">
	<link href="{{URL::asset('admin_assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css')}}" rel="stylesheet">
	<link href="{{URL::asset('admin_assets/plugins/pickerjs/picker.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ trans('site.table') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ removebeginninLetters(trans_choice('site.reports', 1), 2) .' '. trans_choice('site.clients', 1) }}</span>
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
                                <h4 class="card-title mg-b-0">{{ removebeginninLetters(trans_choice('site.reports', 1), 2) .' '. trans_choice('site.clients', 1) }}</h4>
                                <i class="mdi mdi-dots-horizontal text-gray"></i>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <form action="{{ route('admin.clients.reports') }}" method="GET">
                                <div class="row">
                                    <div class="form-group col-lg">
                                        <label for="contract_amount">{{ trans('site.date_attr', ['attr' => trans('site.beginning')]) }}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                                                </div>
                                            </div><input class="form-control @error('start_date') is-invalid @enderror fc-datepicker" name="start_date" placeholder="MM/DD/YYYY" type="text" value="{{ old('start_date', request()->start_date) }}">
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
                                            </div><input class="form-control @error('end_date') is-invalid @enderror fc-datepicker" name="end_date" placeholder="MM/DD/YYYY" type="text" value="{{ old('end_date',request()->end_date) }}">
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
                            <table id="example" class="table table-striped dt-responsive text-center mg-b-0 text-md-nowrap" style="width:100%">
								<thead>
									<tr>
										<th class="border-bottom-0">{{ trans('site.name') }}</th>
										<th class="border-bottom-0">{{ trans('site.user_name') }}</th>
										<th class="border-bottom-0">{{ trans('site.address') }}</th>
										<th class="border-bottom-0">{{ trans('site.cases_counts') }}</th>
										<th class="border-bottom-0">{{ trans('site.total') }}</th>
										<th class="border-bottom-0">{{ trans('site.paid') }}</th>
										<th class="border-bottom-0">{{ trans('site.remaining_amount') }}</th>
										@canany(['client_show', 'client_edit', 'client_delete'])
											<th class="border-bottom-0">{{ trans('site.actions') }}</th>
										@endcanany
										<th class="border-bottom-0">{{ trans('site.created_at') }}</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($clients as $client)
									<tr>
										<td><a href="{{ (auth()->user()->can('client_show') ? route('admin.clients.show', $client->id) : 'javascript:;') }}">{{ $client->name }}</a>
											<p class="small text-muted">{{ trans('site.nationality') }}: {{ $client->nationality }}</p></td>
										<td>{{ $client->user_name }}
											<p class="small text-muted">{{ trans('site.mobile') }}: <a href="{{ whatsappLink($client->mobile, 'مرحبا: '.$client->name) }}">{{ $client->mobile }}</a></p>
										</td>
										<td>{{ $client->address }}</td>

										<td>{!! $client->lawsuites_count > 0 ?  "<a href='".(auth()->user()->can('lawsuite_list') ? route('admin.lawsuites.index', ['client' => $client->id]) : 'javascript:;')."'>". $client->lawsuites_count."</a>" : $client->lawsuites_count !!}
											<span class="d-block small text-warning font-weight-bold">{{ trans('site.total_amount_with_vat') }}</span>
											{{ $client->clientAccounts->sum('debit') }}
										</td>
										<td>{{ $client->clientAccounts->sum('debit') }}</td>
										<td>{{ $client->clientAccounts->sum('credit') }}</td>
										<td>{{ $client->clientAccounts->sum('debit') - $client->clientAccounts->sum('credit') }}</td>
										@canany(['client_show', 'client_edit', 'client_delete'])
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
														data-nationality="{{ $client->nationality }}"
														data-user_name="{{ $client->user_name }}"
														data-notes="{{ $client->notes }}"
														data-submit_btn="{{ trans('site.update') }}"
														data-modal_title="{{ trans('site.update_attr', ['attr' => trans_choice('site.clients', 0)]) }}"
														data-method="PUT"><i class="las la-pen"></i></button>
													@endcan

													@can('client_delete')
														<button type="button" class="btn btn-sm btn-danger modal-effect"  data-effect="effect-slide-in-right" data-toggle="modal" data-target="#deleteItemModal"
														data-url="{{ route('admin.clients.destroy', $client) }}"
														data-id="{{ $client->id }}"
														data-delete_label="{{ trans('site.sure_delete_attr', ['attr' => $client->name]) }}"
														data-modal_title="{{ trans('site.delete_attr', ['attr' => trans_choice('site.clients', 0)]) }}"><i class="las la-trash"></i></button>
													@endcan
												</div>
											</td>
										@endcanany
										<td>{{ $client->created_at->translatedFormat('d M, Y') }}</td>
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

	@can('client_edit')
		@include('admin.clients.partials.modal')
	@endcan

	@can('client_delete')
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
<!--Internal  Datepicker js -->
<script src="{{URL::asset('admin_assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>


<script>
	$(function(e) {

		$('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd',
            showOtherMonths: true,
            selectOtherMonths: true
        });

		@can('client_edit')
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
		@endcan

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
	});

    
</script>
@endsection