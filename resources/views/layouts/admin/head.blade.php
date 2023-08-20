<!-- Title -->
<title> {{ getSettingOf('site_title') ?? config('app.name', 'Laravel') }} - @yield('title', trans('site.home')) </title>
<!-- Favicon -->
{{ Html::favicon( getSettingOf('favicon') != null ? asset('images/settings/favicon/'.getSettingOf('favicon')) : asset('admin_assets/img/favicon-32x32.png') ) }}

<!-- Icons css -->
<link href="{{URL::asset('admin_assets/css/icons.css')}}" rel="stylesheet">
<!--  Custom Scroll bar-->
<link href="{{URL::asset('admin_assets/plugins/mscrollbar/jquery.mCustomScrollbar.css')}}" rel="stylesheet"/>
<!--  Sidebar css -->
<link href="{{URL::asset('admin_assets/plugins/sidebar/sidebar.css')}}" rel="stylesheet">
<!-- Sidemenu css -->
<link rel="stylesheet" href="{{URL::asset('admin_assets/css-rtl/sidemenu.css')}}">
@yield('css')
<style>
	.badge {
		font-family: 'Cairo', sans-serif !important;
	}
</style>
<!--- Style css -->
<link href="{{URL::asset('admin_assets/css-rtl/style.css')}}" rel="stylesheet">
<!--- Dark-mode css -->
<link href="{{URL::asset('admin_assets/css-rtl/style-dark.css')}}" rel="stylesheet">
<!---Skinmodes css-->
<link href="{{URL::asset('admin_assets/css-rtl/skin-modes.css')}}" rel="stylesheet">