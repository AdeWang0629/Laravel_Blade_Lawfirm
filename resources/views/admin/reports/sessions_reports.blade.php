@extends('layouts.admin.master')

@section('title', removebeginninLetters(trans_choice('site.reports', 1), 2) .' '. trans_choice('site.sessions', 1))

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
                <h4 class="content-title mb-0 my-auto">{{ trans('site.table') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ removebeginninLetters(trans_choice('site.reports', 1), 2) .' '. trans_choice('site.sessions', 1) }}</span>
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
									<h4 class="card-title mg-b-0">{{ removebeginninLetters(trans_choice('site.reports', 1), 2) .' '. trans_choice('site.sessions', 1) }}</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
							</div>

							<div class="card-body">
                                <form action="{{ route('admin.sessions.reports') }}" method="GET">
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
                                            <th class="border-bottom-0">{{ trans('site.lawsuite_file_number') }}</th>
                                            <th class="border-bottom-0">{{ trans('site.name_attr', ['attr' => trans_choice('site.clients', 0)]) }}</th>
                                            <th class="border-bottom-0">{{ removebeginninLetters(trans('site.title'), 2) .' '. trans_choice('site.sessions',0) }}</th>
                                            <th class="border-bottom-0">{{ trans('site.date_attr', ['attr' => trans_choice('site.sessions', 0)]) }}</th>
                                            <th class="border-bottom-0">{{ trans_choice('site.courts', 0) }}</th>
                                            @canany(['caseSession_show', 'caseSession_edit', 'caseSession_delete'])
                                                <th class="border-bottom-0">{{ trans('site.actions') }}</th>
                                            @endcanany
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($caseSessions as $caseSession)
                                        <tr>
                                            <td><a href="{{ auth()->user()->can('lawsuite_show') ? route('admin.lawsuites.show', $caseSession->lawsuite_id) : 'javascript:;' }}">{{ $caseSession->lawsuite->case_number }}</a></td>
                                            <td><a href="{{ (auth()->user()->can('client_show') ? route('admin.clients.show', $caseSession->lawsuite->client->id) : 'javascript:;') }}">{!! $caseSession->lawsuite->client->trashed() ? '<span class="text-decoration-line-through text-muted">'.$caseSession->lawsuite->client->name.'</span>' : $caseSession->lawsuite->client->name !!}</a></td>
                                            <td><a href="{{ auth()->user()->can('caseSession_show') ? route('admin.case-sessions.show', $caseSession) : 'javascript:;' }}">{{ $caseSession->title }}</a></td>
                                            <td>{{ $caseSession->start->format('Y-m-d') }}</td>
                                            <td>{!! $caseSession->court->trashed() ? '<span class="text-decoration-line-through text-muted">'.$caseSession->court->name.'</span>' : $caseSession->court->name !!}</td>
                                            @canany(['caseSession_show', 'caseSession_edit', 'caseSession_delete'])
                                                <td>
                                                    <div class="btn-group">
                                                        @can('caseSession_show')
                                                            <a href="{{ route('admin.case-sessions.show', $caseSession) }}" class="btn btn-sm btn-primary"><i class="las la-eye"></i></a>
                                                        @endcan

                                                        @can('caseSession_edit')
                                                            <a href="{{ route('admin.case-sessions.edit', $caseSession) }}" class="btn btn-sm btn-success"><i class="las la-edit"></i></a>
                                                        @endcan

                                                        @can('caseSession_delete')
                                                            <button type="button" class="btn btn-sm btn-danger modal-effect"  data-effect="effect-slide-in-right" data-toggle="modal" data-target="#deleteItemModal"
                                                            data-url="{{ route('admin.case-sessions.destroy', $caseSession) }}"
                                                            data-id="{{ $caseSession->id }}"
                                                            data-delete_label="{{ trans('site.sure_delete_attr', ['attr' => $caseSession->title]) }}"
                                                            data-modal_title="{{ trans('site.delete_attr', ['attr' => trans('site.session')]) }}"><i class="las la-trash"></i></button>
                                                        @endcan
                                                    </div>
                                                </td>
                                            @endcanany
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
</script>
@endsection
