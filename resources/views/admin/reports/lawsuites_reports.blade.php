@extends('layouts.admin.master')

@section('title', removebeginninLetters(trans_choice('site.reports', 1), 2) .' '. trans_choice('site.lawsuites', 1))

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
                <h4 class="content-title mb-0 my-auto">{{ trans('site.table') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ removebeginninLetters(trans_choice('site.reports', 1), 2) .' '. trans_choice('site.lawsuites', 1) }}</span>
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
									<h4 class="card-title mg-b-0">{{ removebeginninLetters(trans_choice('site.reports', 1), 2) .' '. trans_choice('site.lawsuites', 1) }}</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
							</div>

							<div class="card-body">
                                <form action="{{ route('admin.lawsuites.reports') }}" method="GET">
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
								<table id="table_report" class="table table-striped dt-responsive mg-b-0 text-md-nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0">{{ trans('site.lawsuite_file_number') }}</th>
                                            <th class="border-bottom-0" style="width:15%">{{ trans('site.name_attr', ['attr' => trans_choice('site.clients', 0)]) }}</th>
                                            <th class="border-bottom-0" style="width:10%">{{ trans_choice('site.courts', 0) }}</th>
                                            <th class="border-bottom-0">{{ removebeginninLetters(trans_choice('site.stages', 0), 2) .' '. trans('site.litigation') }}</th>
                                            <th class="border-bottom-0">{{ trans('site.amount_attr', ['attr' => trans_choice('site.contracts', 0)]) }}</th>
                                            <th class="border-bottom-0">{{ trans('site.amount_attr', ['attr' => trans('site.vat')]) }}</th>
                                            <th class="border-bottom-0">{{ trans('site.contract_amount_including_tax') }}</th>
                                            <th class="border-bottom-0">{{ trans('site.paid') }}</th>
                                            <th class="border-bottom-0">{{ trans('site.remaining') }}</th>
                                            <th class="border-bottom-0">{{ trans('site.created_at') }}</th>
                                            @canany(['lawsuite_showContract', 'lawsuite_edit', 'lawsuite_delete'])
                                                <th class="border-bottom-0">{{ trans('site.actions') }}</th>
                                            @endcanany
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($lawsuites as $lawsuite)
                                        <tr>
                                            <td><a href="{{ (auth()->user()->can('lawsuite_show') ? route('admin.lawsuites.show', $lawsuite) : 'javascript:;') }}">{{ $lawsuite->case_number }}</a><br><span class="badge badge-secondary" style="background-color: {{ $lawsuite->lawsuitCase->color }}">{!! $lawsuite->lawsuitCase->trashed() ? '<span class="text-decoration-line-through text-white">'.$lawsuite->lawsuitCase->name.'</span>' : $lawsuite->lawsuitCase->name !!}</span></td>
                                            <td><a href="{{ (auth()->user()->can('client_show') ? route('admin.clients.show', $lawsuite->client_id) : 'javascript:;') }}">{!! $lawsuite->client->trashed() ? '<span class="text-decoration-line-through text-muted">'.$lawsuite->client->name.'</span>' : $lawsuite->client->name !!}</a> <p class="small text-muted">{!! $lawsuite->clientType->trashed() ? '<span class="text-decoration-line-through text-muted">'.$lawsuite->clientType->name.'</span>' : $lawsuite->clientType->name !!}</p></td>
                                            <td>{{ $lawsuite->court->name }} <p class="small text-muted">{{ removebeginninLetters(trans_choice('site.categories', 0), 2) .' '. trans_choice('site.lawsuites', 0) }}: {!! $lawsuite->caseType->trashed() ? '<span class="text-decoration-line-through text-muted">'.$lawsuite->caseType->name.'</span>' : $lawsuite->caseType->name !!}</p></td>
                                            <td>{!! $lawsuite->caseStage->trashed() ? '<span class="text-decoration-line-through text-muted">'.$lawsuite->caseStage->name.'</span>' : $lawsuite->caseStage->name !!}</td>
                                            <td>{{ number_format($lawsuite->contract_amount, 2) }}</td>
                                            <td>{{ number_format($lawsuite->vatValue, 2) }}</td>
                                            <td>{{ number_format($lawsuite->total_amount, 2) }}</td>
                                            <td>{{ $lawsuite->clientAccounts->sum('credit') }}</td>
                                            <td>{{ $lawsuite->total_amount - $lawsuite->clientAccounts->sum('credit') }}</td>
                                            <td>{{ $lawsuite->created_at->translatedFormat('d M, Y') }}</td>
                                            @canany(['lawsuite_showContract', 'lawsuite_edit', 'lawsuite_delete'])
                                                <td>
                                                    <div class="btn-group">
                                                        @can('lawsuite_showContract')
                                                            <a href="{{ route('admin.show.contract', $lawsuite) }}" target="_blank" class="btn btn-sm btn-success"><i class="fas fa-file-contract"></i></a>
                                                        @endcan

                                                        @can('lawsuite_edit')
                                                            <a href="{{ route('admin.lawsuites.edit', $lawsuite) }}" class="btn btn-sm btn-info"><i class="las la-pen"></i></a>
                                                        @endcan

                                                        @can('lawsuite_delete')
                                                            <button type="button" class="btn btn-sm btn-danger modal-effect"  data-effect="effect-slide-in-right" data-toggle="modal" data-target="#deleteItemModal"
                                                            data-url="{{ route('admin.lawsuites.destroy', $lawsuite) }}"
                                                            data-id="{{ $lawsuite->id }}"
                                                            data-delete_label="{{ trans('site.sure_delete_attr', ['attr' => $lawsuite->case_number]) }}"
                                                            data-modal_title="{{ trans('site.delete_attr', ['attr' => trans_choice('site.lawsuites', 0)]) }}"><i class="las la-trash"></i></button>
                                                        @endcan
                                                    </div>
                                                </td>
                                            @endcanany
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr class="bg-light text-warning font-weight-bold">
                                            <td colspan="4" class="text-center">{{ trans('site.total') }}</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            @canany(['lawsuite_showContract', 'lawsuite_edit', 'lawsuite_delete'])
                                                <td></td>
                                            @endcanany
                                        </tr>
                                    </tfoot>
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

        @can('lawsuite_delete')
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

        var table = $('#table_report').DataTable({
            "lengthChange": false,
            "iDisplayLength": 10,
            "buttons": [ 'copy', 'excel' ],
            "language": {
                "buttons": {
                    "copy": 'نسخ',
                    "excel": 'إكسل',
                    "colvis": 'الاعمدة الظاهره',
                    "copyTitle": 'نسخ إلى الحافظة',
                    "copyKeys": 'اضغط على <i>ctrl</i> أو <i>\u2318</i> + <i>C</i> لنسخ بيانات الجدول إلى الحافظة الخاصة بك.<br><br> للإلغاء ، انقر فوق هذه الرسالة أو اضغط على Esc.',
                    "copySuccess": {
                        _: '%d صفوف منسوخة',
                        1: '1 تم نسخ الخط'
                    }
                },
                "sProcessing": "جارٍ التحميل...",
                "sLengthMenu": "أظهر _MENU_ مدخلات",
                "sZeroRecords": "لم يعثر على أية سجلات",
                "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
                "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
                "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
                "sInfoPostFix": "",
                "searchPlaceholder": 'ابحث...',
                "sSearch": "",
                "sUrl": "",
                "oPaginate": {
                    "sFirst": "الأول",
                    "sPrevious": "السابق",
                    "sNext": "التالي",
                    "sLast": "الأخير"
                }
            },
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api();

                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ? i.replace(/[\$,]/g, '')*1 : typeof i === 'number' ? i : 0;
                };

                // Total over this page
                pageTotal4 = api.column( 4, { page: 'current'} ).data().reduce( function (a, b) {return intVal(a) + intVal(b);}, 0 );
                pageTotal5 = api.column( 5, { page: 'current'} ).data().reduce( function (a, b) {return intVal(a) + intVal(b);}, 0 );
                pageTotal6 = api.column( 6, { page: 'current'} ).data().reduce( function (a, b) {return intVal(a) + intVal(b);}, 0 );
                pageTotal7 = api.column( 7, { page: 'current'} ).data().reduce( function (a, b) {return intVal(a) + intVal(b);}, 0 );
                pageTotal8 = api.column( 8, { page: 'current'} ).data().reduce( function (a, b) {return intVal(a) + intVal(b);}, 0 );

                // Update footer
                $( api.column(4).footer() ).html(pageTotal4.toFixed(2));
                $( api.column(5).footer() ).html(pageTotal5.toFixed(2));
                $( api.column(6).footer() ).html(pageTotal6.toFixed(2));
                $( api.column(7).footer() ).html(pageTotal7.toFixed(2));
                $( api.column(8).footer() ).html(pageTotal8.toFixed(2));
            }
        });
        table.buttons().container()
        .appendTo( '#table_report_wrapper .col-md-6:eq(0)' );


		$('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd',
            showOtherMonths: true,
            selectOtherMonths: true
        });

		@can('lawsuite_delete')
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
