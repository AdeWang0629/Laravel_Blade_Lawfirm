@extends('layouts.admin.master')

@section('title', trans_choice('site.backups', 1))

@section('css')
    <!-- Internal Data table css -->
    <link href="{{URL::asset('admin_assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('admin_assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('admin_assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('admin_assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('admin_assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <style>
        #create-new-backup-button.loading>.la-spinner {
            display: inherit;
        }
        #create-new-backup-button>.la-spinner,
        #create-new-backup-button.loading>.la-plus {
            display: none;
        }
    </style>
@endsection

@section('page-header')
	<!-- breadcrumb -->
	<div class="breadcrumb-header justify-content-between">
		<div class="my-auto">
			<div class="d-flex">
				<h4 class="content-title mb-0 my-auto">{{ trans('site.table') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans_choice('site.backups', 1) }}</span>
			</div>
		</div>
        <div class="d-flex my-xl-auto right-content">
            <div class="pr-1 mb-3 mb-xl-0">
                @can('backups_create')
                    <button id="create-new-backup-button" href="{{ route('admin.backup.store') }}" class="btn btn-sm btn-info mb-2">
                        <i class="las la-spinner fa-spin"></i>
                        <i class="las la-plus"></i>
                        <span>{{ trans('site.create_a_new_backup') }}</span>
                    </button>
                @else
                    <button type="button" class="btn btn-sm btn-info mb-2 disabled"><i class="mdi mdi-plus"></i> {{ trans('site.create_a_new_backup') }}</button>
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
                    <div class="card mg-b-20">
                        <div class="card-body p-0">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">{{ trans_choice('site.backups', 1) }}</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
								<p class="tx-12 tx-gray-500 mb-2">{{ trans('site.here_you_can',['attr' => trans_choice('site.backups', 1)]) }}...</p>
							</div>

                            <div class="card-body">
                                @can('backups_list')
                                    <table id="example" class="table table-striped dt-responsive text-center mg-b-0 text-md-nowrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0">#</th>
                                                <th class="border-bottom-0">{{ trans('site.name_attr', ['attr' => trans_choice('site.backups', 0)]) }}</th>
                                                <th class="border-bottom-0">{{ trans('site.location') }}</th>
                                                <th class="border-bottom-0">{{ trans('site.created_at') }}</th>
                                                <th class="text-right border-bottom-0">{{ trans('site.file_size') }}</th>
                                                <th class="text-right border-bottom-0">{{ trans('site.actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($backups as $backup)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $backup->fileName }}</td>
                                                <td>{{ $backup->diskName }}</td>
                                                <td>{{ $backup->lastModified }}</td>
                                                <td class="text-right">{{ $backup->fileSize }} MB</td>
                                                <td class="text-right">
                                                    @can('backups_download')
                                                        @if ($backup->downloadLink)
                                                            <a class="btn btn-sm btn-info" data-button-type="download" href="{{ $backup->downloadLink }}"><i class="fa fa-download"></i></a>
                                                        @endif
                                                    @else
                                                        <button type="button" class="btn btn-sm btn-danger disabled"><i class="las la-trash"></i></button>
                                                    @endcan

                                                    @can('backups_delete')
                                                        <a class="btn btn-sm btn-danger" data-button-type="delete" href="{{ $backup->deleteLink }}"><i class="las la-trash"></i></a>
                                                    @else
                                                        <button type="button" class="btn btn-sm btn-danger disabled"><i class="las la-trash"></i></button>
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
    <!--Internal  Datatable js -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const storageKey = 'backpack.backupmanager.created';
            const createButton = document.querySelector('#create-new-backup-button');
            const deleteButtons = document.querySelectorAll('[data-button-type=delete]');
            const downloadButtons = document.querySelectorAll('[data-button-type=download]');
            const defaultHeaders = { 
                'X-CSRF-TOKEN': "{{ csrf_token() }}",
                'Accept': 'application/json',
            };
            const trans = {
                create_started_message: "{{ trans('site.create_started_message') }}",
                create_error_title: "{{ trans('site.create_error_title') }}",
                create_completed_title: "{{ trans('site.create_completed_title') }}",
                download_confirmation_title: "{{ trans('site.download_confirmation_title') }}",
                delete_error_title: "{{ trans('site.delete_error_title') }}",
                delete_confirm: "{{ trans('site.delete_confirm') }}",
                delete_cancel_title: "{{ trans('site.delete_cancel_title') }}",
                delete_cancel_message: "{{ trans('site.delete_cancel_message') }}",
                delete_confirmation_title: "{{ trans('site.delete_confirmation_title') }}",
                delete_confirmation_message: "{{ trans('site.delete_confirmation_message') }}",
            }
            // Set button status helper
            const setCreateButtonLoading = status => {
                createButton.classList.toggle('loading', status);
                createButton.toggleAttribute('disabled', status);
            }

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            // capture the Create new backup button
            createButton.onclick = async e => {
                e.preventDefault();
                setCreateButtonLoading(true);
                Toast.fire({icon: 'success',title: "{{ trans('site.create_started_message') }}"})
                // do the backup through ajax
                try {
                    let response = await fetch(createButton.getAttribute('href'), {
                        method: 'PUT', 
                        headers: defaultHeaders
                    });
                    let result = await response.text();
                    // Show an alert with the result
                    if(!response.ok || result.includes('failed')) {
                        throw new Error(result);
                    }
                    localStorage.setItem(storageKey, true);
                    location.reload();
                }
                catch (result) {
                    // Show an alert with the result
                    Toast.fire({icon: 'warning',title: "{{ trans('site.create_error_title') }}"})
                }
                setCreateButtonLoading(false);
            }
            // capture the delete button
            deleteButtons.forEach(deleteButton => {
                deleteButton.onclick = async e => {
                    e.preventDefault();
                    
                    try {
                        if (!confirm(trans.delete_confirm)) {
                            Toast.fire({icon: 'info',title: "{{ trans('site.delete_cancel_message') }}"})
                        }else {
                            let response = await fetch(deleteButton.getAttribute('href'), {
                                method: 'DELETE', 
                                headers: defaultHeaders
                            });
                            let result = await response.text();
                            // Show an alert with the result
                            if(!response.ok) {
                                throw new Error(result);
                            }
                            Toast.fire({icon: 'success',title: "{{ trans('site.delete_confirmation_message') }}"})
                            // delete the row from the table
                            deleteButton.closest('tr').remove();
                        }
                    }
                    catch (result) {
                        // Show an alert with the result
                        Toast.fire({icon: 'warning',title: "{{ trans('site.delete_error_title') }}"})
                    }
                }
            });
            // capture the download button
            downloadButtons.forEach(downloadButton => {
                downloadButton.onclick = e => Toast.fire({icon: 'success',title: "{{ trans('site.download_confirmation_title') }}"});            
            });
            // Show messages stored on session
            if(localStorage.getItem(storageKey)) {
                localStorage.removeItem(storageKey);
                Toast.fire({icon: 'success',title: "{{ trans('site.create_completed_title') }}"})
            }
        });
    </script>
@endsection
