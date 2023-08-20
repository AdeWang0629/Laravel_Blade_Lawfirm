@extends('layouts.admin.master')

@section('title', trans('site.show_attr', ['attr' => trans_choice('site.sessions', 0)]).': '.$caseSession->title)

@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ trans('site.home') }}</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    {{ trans('site.show_attr', ['attr' => trans_choice('site.sessions', 0)]).': '.$caseSession->title }}</span>
            </div>
        </div>
        @canany(['caseSession_edit', 'lawsuite_show'])
            <div class="d-flex my-xl-auto right-content">
                @can('caseSession_edit')
                    <a href="{{ route('admin.case-sessions.edit', $caseSession->id) }}" class="btn btn-sm btn-success"><i class="mdi mdi-account-edit"></i> {{ trans('site.edit', ['attr' => trans_choice('site.sessions', 0)]) }}</a>
                @else
                    <button type="button" class="btn btn-sm btn-success disabled"><i class="mdi mdi-account-edit"></i> {{ trans('site.edit', ['attr' => trans_choice('site.sessions', 0)]) }}</button>
                @endcan

                @can('lawsuite_show')
                    <a href="{{ route('admin.lawsuites.show', $caseSession->lawsuite->id) }}" class="btn btn-sm btn-primary mr-2"><i class="mdi mdi-arrow-left"></i> {{ trans('site.back_to_attr', ['attr' => trans_choice('site.lawsuites', 0)]) }}</a>
                @else
                    <button type="button" class="btn btn-sm btn-primary mr-2 disabled"><i class="mdi mdi-arrow-left"></i> {{ trans('site.back_to_attr', ['attr' => trans_choice('site.lawsuites', 0)]) }}</button>
                @endcan
            </div>
        @endcanany
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
                        <h4 class="card-title mb-1 text-primary">{{ trans_choice('site.sessions', 0) }}: {{ $caseSession->title }} - {{ trans('site.of_case_no') }}: {{ $caseSession->lawsuite->case_number }}</h4>
                    </div>
                    <div class="card-body pt-0">
                        <span class="text-danger d-block w-100">{{ trans('site.date_attr', ['attr' => trans_choice('site.sessions', 0)]) }}: {{ $caseSession->start->format('Y-m-d') }}</span><span class="text-danger d-block w-100">{{ trans_choice('site.courts', 0) }}: {!! $caseSession->court->trashed() ? '<span class="text-decoration-line-through text-muted">'.$caseSession->court->name.'</span>' : $caseSession->court->name !!}</span>

                        <br>

                        <h5 class="main-profile-name d-block w-100">{{ trans('site.details') .' '. trans_choice('site.sessions', 0)}}:</h5>
                        {!! $caseSession->session_details !!}
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
@endsection
