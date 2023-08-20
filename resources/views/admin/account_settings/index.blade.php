@extends('layouts.admin.master')

@section('title', trans('site.account_settings'))

@section('css')
<!-- Internal Select2 css -->
<link href="{{URL::asset('admin_assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<!--Internal  Datetimepicker-slider css -->
<link href="{{URL::asset('admin_assets/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css')}}" rel="stylesheet">
<link href="{{URL::asset('admin_assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css')}}" rel="stylesheet">
<link href="{{URL::asset('admin_assets/plugins/pickerjs/picker.min.css')}}" rel="stylesheet">
<!-- Internal Spectrum-colorpicker css -->
<link href="{{URL::asset('admin_assets/plugins/spectrum-colorpicker/spectrum.css')}}" rel="stylesheet">
<style>
	.select2-container .select2-search--inline .select2-search__field {
        font-family: inherit !important;
    }
    .select2-container--default[dir="rtl"] .select2-selection--multiple .select2-selection__choice__remove {
        border-left: none !important;
        border-right: 1px solid #aaa !important;
    }
</style>

@endsection
@section('page-header')
	<!-- breadcrumb -->
	<div class="breadcrumb-header justify-content-between">
		<div class="my-auto">
			<div class="d-flex">
				<h4 class="content-title mb-0 my-auto">{{ trans('site.home') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('site.account_settings') }}</span>
			</div>
		</div>
	</div>
	<!-- breadcrumb -->
@endsection
@section('content')
		@include('layouts.admin._partials.errors')

		{{ Form::open(['route' => [auth()->guard('client')->check() ? 'client.account_settings' : 'admin.account_settings'], 'method' => 'POST']) }}
            <!-- row -->
            <div class="row">
                <!--div-->
                <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
                    <div class="card  box-shadow-0 ">
                        <div class="card-header">
                            <h4 class="card-title mb-1 text-primary">{{ trans('site.account_settings') }}</h4>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                @if (auth()->guard('client')->check())
                                    <div class="form-group col-lg">
                                        {{ Form::label('name', trans('site.name')) }}
                                        {{ Form::text('name', old('name', auth()->user()->name), ['class' => 'form-control ' . ( $errors->has('name') ? ' is-invalid' : ''), 'id' => 'name', 'placeholder' => trans('site.name')]) }}
                                        @error('name')
                                            <span class="text-danger small" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                @else
                                    <div class="form-group col-lg">
                                        {{ Form::label('first_name', trans('site.first_name')) }}
                                        {{ Form::text('first_name', old('first_name', auth()->user()->first_name), ['class' => 'form-control ' . ( $errors->has('first_name') ? ' is-invalid' : ''), 'id' => 'first_name', 'placeholder' => trans('site.first_name')]) }}
                                        @error('first_name')
                                            <span class="text-danger small" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg">
                                        {{ Form::label('last_name', trans('site.last_name')) }}
                                        {{ Form::text('last_name', old('last_name', auth()->user()->last_name), ['class' => 'form-control ' . ( $errors->has('last_name') ? ' is-invalid' : ''), 'id' => 'last_name', 'placeholder' => trans('site.last_name')]) }}
                                        @error('last_name')
                                            <span class="text-danger small" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                @endif

                                <div class="form-group col-lg">
                                    {{ Form::label('email', trans('site.email')) }}
                                    {{ Form::email('email', old('user_email', auth()->user()->email), ['class' => 'form-control ' . ( $errors->has('email') ? ' is-invalid' : ''), 'id' => 'email', 'placeholder' => trans('site.email'), 'readonly']) }}
                                    {{ Form::hidden('email', old('email', auth()->user()->email)) }}
                                    @error('email')
                                        <span class="text-danger small" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="w-100"></div>
                                <div class="form-group col-lg">
                                    {{ Form::label('user_name', trans('site.name_attr', ['attr' => trans_choice('site.users', 0)])) }}
                                    {{ Form::text('username', old('user_name', auth()->user()->user_name), ['class' => 'form-control ' . ( $errors->has('user_name') ? ' is-invalid' : ''), 'id' => 'user_name', 'placeholder' => trans('site.name_attr', ['attr' => trans_choice('site.users', 0)]), 'readonly']) }}
                                    {{ Form::hidden('user_name', old('user_name', auth()->user()->user_name)) }}
                                    @error('user_name')
                                        <span class="text-danger small" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group col-lg">
                                    {{ Form::label('password', trans('site.password')) }}
                                    {{ Form::password('password', ['class' => 'form-control ' . ( $errors->has('password') ? ' is-invalid' : ''), 'id' => 'password', 'placeholder' => trans('site.password')]) }}
                                    @error('password')
                                        <span class="text-danger small" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group col-lg">
                                    {{ Form::label('password-confirm', trans('site.confirm_password')) }}
                                    {{ Form::password('password_confirmation', ['class' => 'form-control ' . ( $errors->has('password_confirmation') ? ' is-invalid' : ''), 'id' => 'password-confirm', 'placeholder' => trans('site.confirm_password')]) }}
                                    @error('password_confirmation')
                                        <span class="text-danger small" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                {{ Form::submit(trans('site.update_attr', ['attr' => trans('site.account') ]), ['class' => 'btn btn-primary mb-2']) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {{ Form::close() }}

		</div>
		<!-- Container closed -->
	</div>
	<!-- main-content closed -->
@endsection
@section('js')
	<!-- Internal Select2.min js -->
	<script src="{{URL::asset('admin_assets/plugins/select2/js/select2.min.js')}}"></script>
	<script src="{{URL::asset('admin_assets/plugins/select2/js/i18n/ar.js')}}"></script>
	<script>
        $(function() {
            $('.select2bs4').select2({
                placeholder: "{{ trans('site.select_attr', ['attr' => trans_choice('site.roles', 1)]) }}",
                language: "ar",
                dir: "rtl",
                closeOnSelect: false,
            })
        });
    </script>
@endsection
