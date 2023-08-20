<!-- main-sidebar -->
		<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
		<aside class="app-sidebar sidebar-scroll">
			
			<div class="main-sidemenu">
				<div class="app-sidebar__user clearfix">
					<div class="dropdown user-pro-body">
						<a href="{{ auth()->guard('web')->check() ? route('admin.home') : route('client.dashboard') }}" class="logo d-flex">
							<img src="{{ getSettingOf('logo') != null ? asset('images/settings/logo/'.getSettingOf('logo')) : asset('admin_assets/img/logo.png') }}" class="avatar avatar-xl brround" alt="">
						</a>
						<div class="website-info text-center">
							<h3 class="font-weight-bold text-primary mt-3 mb-0">{{ getSettingOf('site_title') ?? config('app.name') }}</span></h3>
						</div>
						<div class="user-info">
							<h4 class="font-weight-semibold mt-3 mb-0">{{ auth()->guard('client')->check() ? auth()->user()->name : auth()->user()->user_name }}</h4>
							<span class="mb-0 text-muted">{{ auth()->user()->email }}</span>
							@if (auth()->guard('web')->check())
								<br><span class="mb-0 text-warning">{{ auth()->user()->roles->pluck('name')->join(', ') }}</span>
							@endif

							
						</div>
					</div>
				</div>
				
				@if (auth()->guard('web')->check())
					@include('layouts.admin.sidebars.admin_sidebar')
				@elseif (auth()->guard('client')->check())
					@include('layouts.admin.sidebars.client_sidebar')
				@endif
			</div>
		</aside>
<!-- main-sidebar -->
