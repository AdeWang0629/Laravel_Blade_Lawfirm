@extends('errors::minimal')

@section('title', trans('site.server_error'))

@section('css')
    <!--- Internal Fontawesome css-->
    <link href="{{URL::asset('admin_assets/plugins/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <!---Ionicons css-->
    <link href="{{URL::asset('admin_assets/plugins/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
    <!---Internal Typicons css-->
    <link href="{{URL::asset('admin_assets/plugins/typicons.font/typicons.css')}}" rel="stylesheet">
    <!---Internal Feather css-->
    <link href="{{URL::asset('admin_assets/plugins/feather/feather.css')}}" rel="stylesheet">
    <!---Internal Falg-icons css-->
    <link href="{{URL::asset('admin_assets/plugins/flag-icon-css/css/flag-icon.min.css')}}" rel="stylesheet">
@endsection
@section('content')
		<!-- Main-error-wrapper -->
		<div class="main-error-wrapper  page page-h ">
			<img src="{{URL::asset('admin_assets/img/media/500.png')}}" class="error-page" alt="error">
			<h2>{{ trans('site.msg_404') }}</h2>
			<h6>{{ trans('site.you_may_have_mistyped') }}</h6><a class="btn btn-outline-danger" href="{{ request()->is('dashboard/client/*') ? route('client.dashboard') : route('admin.home')}}">{{ trans('site.back_to_home') }}</a>
		</div>
		<!-- /Main-error-wrapper -->
@endsection
@section('js')
@endsection