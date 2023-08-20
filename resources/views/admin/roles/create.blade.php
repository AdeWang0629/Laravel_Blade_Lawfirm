@extends('layouts.admin.master')

@section('title', trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.roles', 0), 2)]))

@section('css')
@endsection
@section('page-header')
	<!-- breadcrumb -->
	<div class="breadcrumb-header justify-content-between">
		<div class="my-auto">
			<div class="d-flex">
				<h4 class="content-title mb-0 my-auto">{{ trans('site.home') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.roles', 0), 2)]) }}</span>
			</div>
		</div>
        <div class="d-flex my-xl-auto right-content">
            <div class="pr-1 mb-3 mb-xl-0">
                @can('roles_list')
                    <a href="{{ route('admin.roles.index') }}" class="btn btn-sm btn-success">{{ trans('site.all_attr', ['attr' => trans_choice('site.roles', 1)]) }} <i class="fas fa-long-arrow-alt-left"></i></a>
                @else
                    <button type="button" class="btn btn-sm btn-success disabled">{{ trans('site.all_attr', ['attr' => trans_choice('site.roles', 1)]) }} <i class="fas fa-long-arrow-alt-left"></i></button>
                @endcan
            </div>
        </div>
	</div>
	<!-- breadcrumb -->
@endsection
@section('content')
		@include('layouts.admin._partials.errors')
		<form action="{{ route('admin.roles.store') }}" method="POST">
            @csrf

            <!-- row -->
            <div class="row">
                <!--div-->
                <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
                    <div class="card  box-shadow-0 ">
                        <div class="card-header">
                            <h4 class="card-title mb-1 text-primary">{{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.roles', 0), 2)]) }}</h4>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="form-group col-lg">
                                    <label for="name">{{ trans('site.name') }}</label>
                                    <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="name" name="name" placeholder="{{ trans('site.name_attr', ['attr' => trans_choice('site.roles', 0)]) }}" value="{{ old('name', request()->input('name')) }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="w-100"></div>
                                <div class="form-group col-lg">
                                    <label for="permissions_id">{{ trans('site.select_attr', ['attr' => trans_choice('site.permissions', 1)]) }}</label>

                                    <div class="roles-checkbox">
                                        <label class="ckbox"><input type="checkbox" id="checkAll"> <span class="font-weight-bold">الكل</span></label>
                                    </div>
                                    <div class="row">
                                        @foreach ($permissions as $key => $item)
                                            <div class="main-roles col-lg-2 mg-t-10">
                                                <label class="ckbox"><input type="checkbox" name="permissions_id[]" value="{{ $key }}"   {{ in_array($key, old('permissions_id', [])) ? 'checked' : '' }}><span>{{ trans('site.'.$item) }}</span></label>
                                            </div>
                                        @endforeach
                                    </div>
                                    @error('permissions_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary mt-2">{{ trans('site.add_new', ['attr' => trans_choice('site.roles', 0)]) }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>

		</div>
		<!-- Container closed -->
	</div>
	<!-- main-content closed -->
@endsection
@section('js')
    <script>
        $(function() {
            'use strict'

            $('.main-roles .ckbox input').each(function() {
                if($(this).length == $(this).filter(":checked").length){
                    $('#checkAll').prop('checked', true);
                }else {
                    $('#checkAll').prop('checked', false);
                }
            });

            $('#checkAll').on('click', function() {
                if ($(this).is(':checked')) {
                    $('.main-roles .ckbox input').each(function() {
                        $(this).prop('checked', true);
                    });
                } else {
                    $('.main-roles .ckbox input').each(function() {
                        $(this).prop('checked', false);
                    });
                }

            });

            $('.main-roles .ckbox input').change(function(){
                var a = $('.main-roles .ckbox input');
                if(a.length == a.filter(":checked").length){
                    $('#checkAll').prop('checked', true);
                }else {
                    $('#checkAll').prop('checked', false);
                }
            });
        });
    </script>
@endsection
