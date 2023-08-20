@extends('layouts.admin.master2')

@section('title', trans('site.login'))

@section('css')
    <style>
        .bg-primary-transparent {
            background: url({{ asset('admin_assets/img/login-bg.jpg') }});
            background-repeat: no-repeat;
            background-size: cover;
        }
        .login .bg {
            position: absolute;
            right: 0;
            left: 0;
            bottom: 0;
            top: 0;
            z-index: -1;
            opacity: 0.8;
        }
        .col-sm-6 {
            flex: 0 0 50%;
            max-width: 50%;
        }
        @media (max-width: 767px) {
            .main-signup-header, .main-card-signin {
                padding: unset !important;
                border: unset !important;
                border-radius: unset !important;
            }
        }
        
    </style>
@endsection
@section('content')
		<div class="container-fluid">
			<div class="login d-flex align-items-center py-2">
                <div class="col-lg-4 col-md-6 col-sm-10 mx-auto">
                    <div class="bg bg-white p-2"></div>
                    <div class="card-sigin p-4">

                        <div class="mb-3 text-center"> <a href="#">
                            <img src="{{ getSettingOf('logo') != null ? asset('images/settings/logo/'.getSettingOf('logo')) : asset('admin_assets/img/logo.png') }}" class="sign-favicon ht-40 avatar-xl brround" alt="{{ getSettingOf('site_title') ?? config('app.name') }}"></a><h1 class="main-logo1 mt-2 tx-28">{{ getSettingOf('site_title') ?? config('app.name') }}</h1>
                        </div>
                        <div class="card-sigin">
                            <div class="main-signup-header">
                                <h2 class="text-center">{{ trans('site.welcome_back') }}</h2>
                                <h5 class="font-weight-semibold mb-4 text-center">{{ trans('site.login').' "'.trans_choice('site.clients', 0).'"' }}</h5>
                                <form method="POST" action="{{ route('client.login') }}">
                                    @csrf

                                    <div class="form-group">
                                        <label for="login" class="col-form-label text-md-end">{{ trans('site.username_or_email') }}</label>
                                        <input id="login" type="text" class="form-control @error('login') is-invalid @enderror" name="login" value="{{ old('login') }}" required autofocus>
        
                                        @error('login')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div> 

                                    <div class="form-group">
                                        <label for="password" class="col-form-label text-md-end">{{ trans('site.password') }}</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        
                                            <label class="form-check-label" for="remember">
                                                {{ trans('site.remember_me') }}
                                            </label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-main-primary btn-block">
                                        {{ trans('site.login') }}
                                    </button>
                                </form>

                                <div class="row row-xsr mt-3">
                                    <div class="col-sm-6">
                                        @if (getSettingOf('gmail_email') != null && getSettingOf('gmailPassword') != null)
                                            <div class="main-signin-footer">
                                                @if (Route::has('client.password.request'))
                                                    <p>
                                                        <a href="{{ route('client.password.request') }}">
                                                            {{ trans('site.forgot_your_password') }}
                                                        </a>
                                                    </p>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="main-signin-footer text-left">
                                            @if (Route::has('login.show'))
                                                <p>
                                                    <a href="{{ route('login.show') }}">{{ trans('site.login').' "'.trans('site.admin').'"' }}</a>
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
@endsection
@section('js')
@endsection