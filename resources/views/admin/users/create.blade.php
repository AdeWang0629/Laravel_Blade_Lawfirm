@extends('layouts.admin.master')

@section('title', trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.users', 0), 2)]))

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
				<h4 class="content-title mb-0 my-auto">{{ trans('site.home') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.users', 0), 2)]) }}</span>
			</div>
		</div>
        <div class="d-flex my-xl-auto right-content">
            <div class="pr-1 mb-3 mb-xl-0">
                @can('users_list')
                    <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-success">{{ trans('site.all_attr', ['attr' => trans_choice('site.users', 1)]) }} <i class="fas fa-long-arrow-alt-left"></i></a>
                @else
                    <button type="button" class="btn btn-sm btn-success disabled">{{ trans('site.all_attr', ['attr' => trans_choice('site.users', 1)]) }} <i class="fas fa-long-arrow-alt-left"></i></button>
                @endcan
            </div>
        </div>
	</div>
	<!-- breadcrumb -->
@endsection
@section('content')
		@include('layouts.admin._partials.errors')
		{{ Form::open(['route' => ['admin.users.store'], 'method' => 'POST']) }}

        <!-- row -->
        <div class="row">
            <!--div-->
            <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
                <div class="card  box-shadow-0 ">
                    <div class="card-header">
                        <h4 class="card-title mb-1 text-primary">{{ trans('site.add_new', ['attr' => trans_choice('site.users', 0)]) }}</h4>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="form-group col-lg">
                                {{ Form::label('first_name', trans('site.first_name')) }}
                                {{ Form::text('first_name', old('first_name'), ['class' => 'form-control ' . ( $errors->has('name') ? ' is-invalid' : ''), 'id' => 'name', 'placeholder' => trans('site.first_name')]) }}
                                @error('first_name')
                                    <span class="text-danger small" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-lg">
                                {{ Form::label('last_name', trans('site.last_name')) }}
                                {{ Form::text('last_name', old('last_name'), ['class' => 'form-control ' . ( $errors->has('name') ? ' is-invalid' : ''), 'id' => 'name', 'placeholder' => trans('site.last_name')]) }}
                                @error('last_name')
                                    <span class="text-danger small" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-lg">
                                {{ Form::label('email', trans('site.email')) }}
                                {{ Form::email('email', old('email'), ['class' => 'form-control ' . ( $errors->has('email') ? ' is-invalid' : ''), 'id' => 'email', 'placeholder' => trans('site.email')]) }}
                                @error('email')
                                    <span class="text-danger small" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="w-100"></div>
                            <div class="form-group col-lg">
                                {{ Form::label('user_name', trans('site.name_attr', ['attr' => trans_choice('site.users', 0)])) }}
                                {{ Form::text('user_name', old('user_name'), ['class' => 'form-control ' . ( $errors->has('user_name') ? ' is-invalid' : ''), 'id' => 'user_name', 'placeholder' => trans('site.name_attr', ['attr' => trans_choice('site.users', 0)])]) }}
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
                            <div class="w-100"></div>
                            <div class="form-group col-lg">
                                <div class="form-group">
                                    {{ Form::label('roles', trans('site.select_attr', ['attr' => trans_choice('site.roles', 1)])) }}
                                    {{ Form::select('roles_id[]', [''=>'']+$roles, old('roles_id', []), ['class' => 'form-control select2bs4 ' . ($errors->has('roles_id') ? ' is-invalid' : '' ), 'id' => 'roles', 'placeholder' => trans('site.select_attr', ['attr' => trans_choice('site.roles', 1)]),  'multiple'=>'multiple']) }}
                                    @error('roles_id')
                                        <span class="text-danger small" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-lg">
                                <div class="form-group">
                                    {{ Form::label('status', trans('site.user_status')) }}
                                    {{ Form::select('status', [1 => trans('site.active'), 0 => trans('site.in_active')], old('status'), ['class' => 'form-control ' . ($errors->has('status') ? ' is-invalid' : '' ), 'id' => 'status', 'placeholder' => trans('site.select_attr', ['attr' => trans('site.user_status')])]) }}
                                    @error('status')
                                        <span class="text-danger small" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::submit(trans('site.add_new', ['attr' => trans_choice('site.users', 0)]), ['class' => 'btn btn-primary mb-2']) }}
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
