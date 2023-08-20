<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
		<meta name="Author" content="Spruko Technologies Private Limited">
		<meta name="Keywords" content="admin,admin dashboard,admin dashboard template,admin panel template,admin template,admin theme,bootstrap 4 admin template,bootstrap 4 dashboard,bootstrap admin,bootstrap admin dashboard,bootstrap admin panel,bootstrap admin template,bootstrap admin theme,bootstrap dashboard,bootstrap form template,bootstrap panel,bootstrap ui kit,dashboard bootstrap 4,dashboard design,dashboard html,dashboard template,dashboard ui kit,envato templates,flat ui,html,html and css templates,html dashboard template,html5,jquery html,premium,premium quality,sidebar bootstrap 4,template admin bootstrap 4"/>

		<!-- Title -->
		<title> {{ getSettingOf('site_title') ?? config('app.name', 'Laravel') }} - @yield('title', trans('site.home')) </title>
		<!-- Favicon -->
		{{ Html::favicon( getSettingOf('favicon') != null ? asset('images/settings/favicon/'.getSettingOf('favicon')) : asset('admin_assets/img/favicon-32x32.png') ) }}

		@yield('css')
		
		<!--- Style css -->
		<link href="{{URL::asset('admin_assets/css-rtl/style.css')}}" rel="stylesheet">
		<!--- Dark-mode css -->
		<link href="{{URL::asset('admin_assets/css-rtl/style-dark.css')}}" rel="stylesheet">
		<!---Skinmodes css-->
		<link href="{{URL::asset('admin_assets/css-rtl/skin-modes.css')}}" rel="stylesheet">
	</head>
	
	<body class="main-body bg-primary-transparent">
		<!-- Loader -->
		<div id="global-loader">
			<img src="{{URL::asset('admin_assets/img/loader.svg')}}" class="loader-img" alt="Loader">
		</div>
		<!-- /Loader -->
		@yield('content')	

		<!-- JQuery min js -->
		<script src="{{URL::asset('admin_assets/plugins/jquery/jquery.min.js')}}"></script>
		<!-- custom js -->
		@yield('js')
	</body>
</html>