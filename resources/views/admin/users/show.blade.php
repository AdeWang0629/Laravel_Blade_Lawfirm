@extends('layouts.admin.master')

@section('title', trans_choice('site.users', 0).': '.$user->user_name)

@section('css')
    <!--Internal  Font Awesome -->
    <link href="{{URL::asset('admin_assets/plugins/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <!--Internal  treeview -->
    <link href="{{URL::asset('admin_assets/plugins/treeview/treeview-rtl.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ trans('site.home') }}</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    {{ trans('site.show_attr', ['attr' => trans_choice('site.users', 0)]).': '.$user->user_name }}</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            @can('users_edit')
                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-success"><i class="mdi mdi-account-edit"></i> {{ trans('site.edit', ['attr' => trans_choice('site.users', 0)]) }}</a>
            @else
                <button type="button" class="btn btn-sm btn-success disabled"><i class="mdi mdi-account-edit"></i> {{ trans('site.edit', ['attr' => trans_choice('site.users', 0)]) }}</button>
            @endcan

            @can('users_list')
                <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-primary mr-2"><i class="mdi mdi-arrow-left"></i> {{ trans('site.back_to_attr', ['attr' => trans_choice('site.users', 1)]) }}</a>
            @else
                <button type="button" class="btn btn-sm btn-primary disabled"><i class="mdi mdi-arrow-left"></i> {{ trans('site.back_to_attr', ['attr' => trans_choice('site.users', 1)]) }}</button>
            @endcan
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
        <!-- row -->
        <div class="row">
            <!--div-->
            <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
                <div class="card  box-shadow-0 ">
                    <div class="card-header">
                        <h4 class="card-title mb-1 text-primary">{{ trans('site.full_name') }}: {{ $user->fullname }} 
                            {!! $user->statusWithLabel() !!}</h4>
                    </div>
                    <div class="card-body pt-0">
                        <span class="text-danger d-block w-100">{{ trans_choice('site.users', 0).': '.$user->user_name }} <span class="text-warning">({{ $user->roles->pluck('name')->join(', ') }})</span></span>
                        <span class="text-danger d-block w-100">{{ trans('site.email') }}: {{ $user->email }}</span>
                        <span class="text-danger d-block w-100">{{ trans('site.created_at') }}: {{ $user->created_at->format('d-m-Y') }}</span>
                        <br>

                        <ul id="treeview1">
                            <li><a href="#" class="font-weight-bold">{{ trans_choice('site.roles', 1) }}</a>
                                <ul>
                                    @forelse ($user->getAllPermissions() as $permission)
                                        <li>{{ trans('site.'.$permission->name) }}</li>
                                    @empty
                                        <li>{{ trans('site.no_attr_yet', ['attr' => removebeginninLetters(trans_choice('site.roles', 1), 2)]) }}</li>
                                    @endforelse
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--/div-->
        </div>
        <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Treeview js -->
    <script src="{{URL::asset('admin_assets/plugins/treeview/treeview.js')}}"></script>
@endsection
