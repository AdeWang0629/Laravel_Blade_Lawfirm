@extends('layouts.admin.master')

@section('title', removebeginninLetters(trans_choice('site.reports', 1), 2) .' '. removebeginninLetters(trans_choice('site.payments', 1), 2) .' '.trans_choice('site.lawsuites', 1))

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
                <h4 class="content-title mb-0 my-auto">{{ trans('site.table') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ removebeginninLetters(trans_choice('site.reports', 1), 2) .' '. removebeginninLetters(trans_choice('site.payments', 1), 2) .' '.trans_choice('site.lawsuites', 1) }}</span>
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
									<h4 class="card-title mg-b-0">{{ removebeginninLetters(trans_choice('site.reports', 1), 2) .' '. removebeginninLetters(trans_choice('site.payments', 1), 2) .' '.trans_choice('site.lawsuites', 1) }}</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
							</div>
                            
							<div class="card-body">
                                <form action="{{ route('admin.lawsuites.payments.reports') }}" method="GET">
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
                                <p class="case-info font-weight-bold">{{ trans('site.total_attr_by_date', ['attr' => trans_choice('site.lawsuites', 1)]) }}: <span class="text-danger">{{ $receipts->sum('debit') }}</span></p>
								<table id="example" class="table table-striped dt-responsive mg-b-0 text-md-nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0">{{ trans('site.lawsuite_file_number') }}</th>
                                            <th class="border-bottom-0">{{ trans('site.name_attr', ['attr' => trans_choice('site.clients', 0)]) }}</th>
                                            <th>{{ removebeginninLetters(trans('site.title'), 2) .' '. trans_choice('site.payments', 0) }}</th>
                                            <th>{{ trans('site.amount_attr', ['attr' => trans_choice('site.payments', 0)]) }}</th>
                                            <th>{{ trans('site.payment_way') }}</th>
                                            <th>{{ trans('site.thats_about') }}</th>
                                            <th>{{ trans('site.date_attr', ['attr' => trans_choice('site.payments', 0)]) }}</th>
                                            @can('lawsuite_showContract')
                                                <th class="border-bottom-0">{{ trans('site.actions') }}</th>
                                            @endcan
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($receipts as $receipt)
                                        <tr>                                                
                                            <td>
                                                <a href="{{ auth()->user()->can('lawsuite_show') ? route('admin.lawsuites.show', $receipt->lawsuite_id) : 'javascript:;' }}">{{ $receipt->lawsuite->case_number}}</a>
                                            </td>
                                            <td><a href="{{ auth()->user()->can('client_show') ? route('admin.clients.show', $receipt->client_id) : 'javascript:;' }}">{{ $receipt->client->name }}</a></td>
                                            <td>{{ $receipt->title }}</td>
                                            <td>{{ $receipt->debit }}</td>
                                            <td>{{ $receipt->payment_type }}</td>
                                            <td>{{ $receipt->note }}</td>
                                            <td>{{ $receipt->date }}</td>
                                            @can('lawsuite_showContract')
                                                <td>
                                                    <a href="{{ route('admin.show.contract', $receipt->lawsuite_id) }}" target="_blank" class="btn btn-sm btn-success"><i class="fas fa-file-contract"></i></a>
                                                </td>
                                            @endcan
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
	});
</script>
@endsection