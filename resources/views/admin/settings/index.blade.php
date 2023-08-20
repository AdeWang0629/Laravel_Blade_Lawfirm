@extends('layouts.admin.master')

@section('title', trans_choice('site.settings', 1))

@section('css')
    <!-- Internal Select2 css -->
    <link href="{{URL::asset('admin_assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <style>
        .list-group-flush>.list-group-item i {
            color: #d1d3e2;
            font-size: 14px;
            margin-{{ config('app.locale') == 'ar' ? 'left' : 'right' }}: 5px;
        }
        .list-group-flush>.list-group-item.active a, .list-group-flush>.list-group-item.active a i {
            color: #fff;
        }
        .preview_image {
            max-width: 150px;
        }
        .main-content-left-mail .btn-compose {
            letter-spacing: unset !important;
            font-size: 15px !important;
            margin-bottom: 5px !important;
        }
    </style>
@endsection

@section('page-header')
	<!-- breadcrumb -->
	<div class="breadcrumb-header justify-content-between">
		<div class="my-auto">
			<div class="d-flex">
				<h4 class="content-title mb-0 my-auto">{{ trans('site.table') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans_choice('site.settings', 1) }}</span>
			</div>
		</div>
	</div>
	<!-- breadcrumb -->
@endsection

@section('content')
        <!-- row -->
        <div class="row row-sm">
            <div class="col-lg-4 col-xl-3">
                <div class="card mg-b-20">
                    <div class="main-content-left main-content-left-mail card-body">
                        <div class="main-mail-menu">
                            <label class="btn btn-primary btn-compose">{{ trans('site.menu') }}</label>
                            <nav class="nav main-nav-column">
                                @foreach ($sectionsArray as $section)
                                <a class="nav-link {{ (request()->section == '' && $loop->first) || request()->section == $section ? 'active' : '' }}" href="{{ route('admin.settings.index', ['section' => $section]) }}">{{ trans('site.'.$section.'_settings') }}</a>
                                @endforeach
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-xl-9">
                {{ Form::model($sectionSettings,['route' => 'admin.settings.update', 'method' => 'PATCH', 'files' => true]) }}
                <div class="card">
                    <div class="card-body">
                        <div class="mb-4 main-content-label">{{ trans('site.'.$sectionQuery.'_settings') }}</div>

                        @foreach ($sectionSettings as $setting)
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    {{ Form::label('value-'.$loop->index, trans('site.'.$setting->display_name)) }}
                                </div>
                                <div class="col-md-9">
                                    @if ($setting->type == 'file')
                                            {{ Form::file('value['.$loop->index.']', ['class' => 'form-control-file' . ( $errors->has('value.'.$loop->index) ? ' is-invalid' : ''), 'id' => 'value-'.$loop->index, 'placeholder' =>  trans('site.'.$setting->display_name)]  ) }}

                                            <div class="preview_image my-2">
                                                <img src="{{ getSettingOf($setting->key) ? asset('images/settings/'.\Str::slug($setting->key).'/'.getSettingOf($setting->key)) : asset('admin_assets/img/default.jpg') }}"
                                                    alt="preview image" class="img-thumbnail">
                                            </div>
                                        @elseif ($setting->type == 'select')
                                            {{ Form::select('value['.$loop->index.']', explode('|', $setting->details), $setting->value, ['class' => 'form-control' . ( $errors->has('value.'.$loop->index) ? ' is-invalid' : ''), 'id' => 'value-'.$loop->index, 'placeholder' =>  trans('site.'.$setting->display_name)]) }}
                                        @elseif ($setting->type == 'password')
                                            {{ Form::password('value['.$loop->index.']', ['class' => 'form-control' . ( $errors->has('value.'.$loop->index) ? ' is-invalid' : ''), 'id' => 'value-'.$loop->index, 'placeholder' =>  trans('site.'.$setting->display_name)]) }}
                                        @elseif ($setting->type == 'email')
                                            {{ Form::email('value['.$loop->index.']', $setting->value, ['class' => 'form-control' . ( $errors->has('value.'.$loop->index) ? ' is-invalid' : ''), 'id' => 'value-'.$loop->index, 'placeholder' =>  trans('site.'.$setting->display_name)]) }}
                                        @elseif ($setting->type == 'number')
                                            {{ Form::number('value['.$loop->index.']', $setting->value, ['class' => 'form-control' . ( $errors->has('value.'.$loop->index) ? ' is-invalid' : ''), 'id' => 'value-'.$loop->index, 'placeholder' =>  trans('site.'.$setting->display_name)]) }}
                                        @else ($setting->type == 'text')
                                            {{ Form::text('value['.$loop->index.']', $setting->value, ['class' => 'form-control' . ( $errors->has('value.'.$loop->index) ? ' is-invalid' : ''), 'id' => 'value-'.$loop->index, 'placeholder' =>  trans('site.'.$setting->display_name)]) }}
                                        @endif
                                        {{ Form::hidden('id['.$loop->index.']', $setting->id, ['class' => 'form-control',
                                        'id' => 'id-'.$loop->index, 'readonly']) }}
                                        {{ Form::hidden('key['.$loop->index.']', $setting->key, ['class' => 'form-control',
                                        'id' => 'key-'.$loop->index, 'readonly']) }}
                                        {{ Form::hidden('ordering['.$loop->index.']', $setting->ordering, ['class' =>
                                        'form-control', 'id' => 'ordering-'.$loop->index, 'readonly']) }}

                                        @error('value.'.$loop->index)
                                            <span class="text-danger small" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                    <div class="card-footer">
                        <div class="float-left">
                            {{ Form::submit(trans('site.save'), ['class' => 'btn btn-success']) }}
                        </div>

                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection

@section('js')
    <!-- Moment js -->
    <script src="{{URL::asset('admin_assets/plugins/raphael/raphael.min.js')}}"></script>
    <!-- Internal Select2.min js -->
    <script src="{{URL::asset('admin_assets/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{URL::asset('admin_assets/js/select2.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function (e) {
            $('input[type=file]').change(function(){
                let that = $(this);
                let preview_image = that.next('.preview_image');
                let reader = new FileReader();
                reader.onload = (e) => {
                    preview_image.find('img').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>
@endsection
