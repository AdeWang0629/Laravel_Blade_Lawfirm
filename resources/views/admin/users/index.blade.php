@extends('layouts.admin.master')

@section('title', trans_choice('site.users', 1))

@section('css')
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ trans('site.table') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans_choice('site.users', 1) }}</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <div class="pr-1 mb-3 mb-xl-0">
                @can('users_create')
                    <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-success"><i class="mdi mdi-plus"></i> {{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.users', 0), 2)]) }}</a>
                @else
                    <button type="button" class="btn btn-sm btn-success disabled"><i class="mdi mdi-plus"></i> {{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.users', 0), 2)]) }}</button>
                @endcan
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
				<!--Row-->
				<div class="row row-sm">
					<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
						<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">{{ trans_choice('site.users', 1) }}</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
								<p class="tx-12 tx-gray-500 mb-2">{{ trans('site.here_you_can',['attr' => trans_choice('site.users', 1)]) }}... 
                                    @can('users_create')
                                        <a href="{{ route('admin.users.create') }}" class="btn btn-link btn-sm p-0"> {{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.users', 0), 2)]) }}</a>
                                    @endcan
                                </p>
							</div>
							<div class="card-body">
								@can('users_list')
									<table id="example" class="table table-striped dt-responsive text-center mg-b-0 text-md-nowrap" style="width:100%">
										<thead>
                                            <tr>
                                                <th class="wd-lg-8p">{{ trans('site.full_name') }}</th>
                                                <th class="wd-lg-8p">{{ trans('site.name_attr' , ['attr' => trans_choice('site.users', 0)]) }}</th>
                                                <th class="wd-lg-20p">{{ trans('site.email') }}</th>
                                                <th class="wd-lg-20p">{{ trans('site.actions') }}</th>
                                                <th class="wd-lg-20p">{{ trans('site.created_at') }}</th>
                                            </tr>
										</thead>
										<tbody>
                                            @forelse ($users as $user)
                                                <tr>
                                                    <td>{{ $user->fullname }} <br> {!! $user->statusWithLabel() !!}</td>
                                                    <td>
                                                        <a href="{{ (auth()->user()->can('users_show') ? route('admin.users.show', $user) : 'javascript:;') }}">{{ $user->user_name }}</a>
                                                        <div class="text-muted small">{{ $user->roles->pluck('name')->join(', ') }}</div>
                                                    </td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            @can('users_show')
                                                                <a href="{{ route('admin.users.show', $user) }}" class="btn btn-sm btn-primary">
                                                                    <i class="las la-eye"></i>
                                                                </a>
                                                            @else
                                                                <button type="button" class="btn btn-sm btn-primary disabled"><i class="las la-eye"></i></button>
                                                            @endcan

                                                            @can('users_edit')
                                                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-success">
                                                                    <i class="las la-edit"></i>
                                                                </a>
                                                            @else
                                                                <button type="button" class="btn btn-sm btn-success disabled"><i class="las la-edit"></i></button>
                                                            @endcan

                                                            @can('users_delete')
                                                                <button type="button" class="btn btn-sm btn-danger modal-effect"  data-effect="effect-slide-in-right" data-toggle="modal" data-target="#deleteItemModal"
                                                                data-url="{{ route('admin.users.destroy', $user) }}"
                                                                data-id="{{ $user->id }}"
                                                                data-delete_label="{{ trans('site.sure_delete_attr', ['attr' => $user->user_name]) }}"
                                                                data-modal_title="{{ trans('site.delete_attr', ['attr' => trans_choice('site.users', 0)]) }}"><i class="las la-trash"></i></button>
                                                            @else
                                                                <button type="button" class="btn btn-sm btn-danger disabled"><i class="las la-trash"></i></button>
                                                            @endcan
                                                        </div>
                                                    </td>
                                                    <td>{{ $user->created_at->format('Y-m-d') }}</td>
                                                </tr>
                                            @empty
                                                <tr><td colspan="4" class="text-center">{{ trans('site.nothig_here_yet', ['attr'=> removebeginninLetters(trans_choice('site.users', 1) ,2) ]) }}</td></tr>
                                            @endforelse
										</tbody>
									</table>
                                    {{ $users->appends(request()->query())->links() }}
                                @else
                                    <div class="alert alert-warning" role="alert">{{ trans('site.user_does_not_have_the_right_permissions') }}</div>
                                @endcan
							</div>
						</div>
					</div><!-- COL END -->
				</div>
				<!-- row closed  -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->

        @can('users_delete')
			@include('admin._partials.delete_modal')
		@endcan
@endsection
@section('js')
<script>
	$(function(e) {

		@can('users_delete')
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