<!-- main-header opened -->
			<div class="main-header sticky side-header nav nav-item">
				<div class="container-fluid">
					<div class="main-header-left ">
						<div class="app-sidebar__toggle" data-toggle="sidebar">
							<a class="open-toggle" href="#"><i class="header-icon fe fe-align-left" ></i></a>
							<a class="close-toggle" href="#"><i class="header-icons fe fe-x"></i></a>
						</div>
					</div>
					<div class="main-header-right">
						<div class="nav nav-item  navbar-nav-right ml-auto">
							<div class="nav-item full-screen fullscreen-button">
								<a class="new nav-link full-screen-link" href="#"><svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-maximize"><path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"></path></svg></a>
							</div>
							<div class="dropdown main-profile-menu nav nav-item nav-link">
								<a class="profile-user d-flex" href=""><img alt="" src="{{ getGravatar(auth()->user()->email, 45) }}"></a>
								<div class="dropdown-menu">
									<div class="main-header-profile bg-primary p-3">
										<div class="d-flex wd-100p">
											<div class="main-img-user"><img alt="" src="{{ getGravatar(auth()->user()->email, 45) }}" class=""></div>
											<div class="mr-3 my-auto">
												<h6>{{ auth()->guard('client')->check() ? auth()->user()->name : auth()->user()->user_name }}</h6><span>{{ auth()->user()->email }}</span>
											</div>
										</div>
									</div>
									<a class="dropdown-item" href="{{ Auth::guard('client')->check() ? route('client.account_settings') : route('admin.account_settings') }}"><i class="bx bx-slider-alt"></i> {{ trans('site.account_settings') }}</a>
									<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="bx bx-log-out"></i> {{ trans('site.logout') }}</a>
									@if (Auth::guard('web')->check())
										<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
									@elseif (Auth::guard('client')->check())
										<form id="logout-form" action="{{ route('client.logout') }}" method="POST" class="d-none">
									@endif
									@csrf
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
<!-- /main-header -->
