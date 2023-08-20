@extends('layouts.admin.master')

@section('title', trans('site.edit', ['attr' => trans_choice('site.sessions', 0)]).': '.$caseSession->title)

@section('css')
    <!-- Internal Select2 css -->
    <link href="{{ URL::asset('admin_assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!--Internal  Datetimepicker-slider css -->
    <link href="{{ URL::asset('admin_assets/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css') }}"
        rel="stylesheet">
    <link href="{{ URL::asset('admin_assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css') }}"
        rel="stylesheet">
    <link href="{{ URL::asset('admin_assets/plugins/pickerjs/picker.min.css') }}" rel="stylesheet">
    <!-- Internal Spectrum-colorpicker css -->
    <link href="{{ URL::asset('admin_assets/plugins/spectrum-colorpicker/spectrum.css') }}" rel="stylesheet">
	<style>
		.sp-replacer.sp-light {
			display: block;
			width: 100%;
			height: 40px;
			padding: 0.375rem 0.75rem;
			font-size: 0.875rem;
			font-weight: 400;
			line-height: 1.5;
			color: #4d5875;
			background-color: #fff;
			background-clip: padding-box;
			border: 1px solid #e1e5ef;
			border-radius: 3px;
			transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
		}
		.sp-preview {
			width: calc(100% - 20px);
			height: -webkit-fill-available;
			margin-right: 10px;
		}
		.sp-dd {
			height: 25px;
			line-height: 22px;
		}
	</style>
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ trans('site.home') }}</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    {{ trans('site.edit', ['attr' => trans_choice('site.sessions', 0)]).': '.$caseSession->title }}</span>
            </div>
        </div>
		@can('lawsuite_show')
			<div class="d-flex my-xl-auto right-content">
				<a href="{{ route('admin.lawsuites.show', $caseSession->lawsuite->id) }}" class="btn btn-sm btn-primary"><i class="mdi mdi-arrow-left"></i> {{ trans('site.back_to_attr', ['attr' => trans_choice('site.lawsuites', 0)]) }}</a>
			</div>
		@else
			<button type="button" class="btn btn-sm btn-primary disabled"><i class="mdi mdi-arrow-left"></i> {{ trans('site.back_to_attr', ['attr' => trans_choice('site.lawsuites', 0)]) }}</button>
		@endcan
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
		<form action="{{ route('admin.case-sessions.update', $caseSession) }}" method="POST">
			@csrf
			@method('PUT')

			<!-- row -->
			<div class="row">
				<!--div-->
				<div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
                    @include('layouts.admin._partials.errors')
					<div class="card  box-shadow-0 ">
						<div class="card-header">
							<h4 class="card-title mb-1 text-primary">{{ trans('site.edit', ['attr' =>  trans_choice('site.sessions', 0)]) }}: {{ $caseSession->title }} - {{ trans('site.of_case_no') }}: {{ $caseSession->lawsuite->case_number }}</h4>
						</div>
						<div class="card-body pt-0">
							<div class="row">
								<div class="form-group col-lg">
									<label for="title">{{ removebeginninLetters(trans('site.title'), 2) .' '. trans_choice('site.sessions',0) }}</label>
									<input type="text" name="title" class="title form-control @error('title') is-invalid @enderror" id="title" value="{{ old('title', $caseSession->title) }}">
									@error('title')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
								<div class="form-group col-lg">
									<label for="start">{{ trans('site.date_attr', ['attr' => trans_choice('site.sessions', 0)]) }}</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<div class="input-group-text">
												<i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
											</div>
										</div><input class="form-control @error('start') is-invalid @enderror fc-datepicker"
											name="start" placeholder="MM/DD/YYYY" type="text" value="{{ old('start', $caseSession->start->format('Y-m-d')) }}">
									</div>
									@error('start')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
								<div class="form-group col-lg">
									<label for="bg_color">{{ trans('site.bg_color_for_calendar') }}</label>
									<input type="text" id="bg_color" name="bg_color" value="{{ old('bg_color', $caseSession->bg_color) }}">
									@error('bg_color')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
								<div class="w-100"></div>
								<div class="form-group col-lg">
									<label for="session_details">{{ removebeginninLetters(trans('site.details'), 2) .' '. trans_choice('site.sessions',0) }}</label>
									<textarea name="session_details" class="form-control @error('session_details') is-invalid @enderror contract_textarea" name="session_details" id="session_details" placeholder="تفاصيل الجلسة">{{ old('session_details', $caseSession->session_details) }}</textarea>
									@error('session_details')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>

								<button class="btn ripple btn-primary save-btn w-100" type="submit">{{ trans('site.update') }}</button>
							</div>
						</div>
					</div>
				</div>
				<!--/div-->
			</div>
			<!-- row closed -->
		</form>

	</div>
	<!-- Container closed -->
	</div>
	<!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('admin_assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('admin_assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!--Internal  pickerjs js -->
    <script src="{{ URL::asset('admin_assets/plugins/pickerjs/picker.min.js') }}"></script>
    <!-- Internal Select2.min js -->
    <script src="{{ URL::asset('admin_assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ URL::asset('admin_assets/plugins/select2/js/i18n/ar.js') }}"></script>
    <!--Internal tinymce js -->
	<script src="{{URL::asset('admin_assets/plugins/tinymce/tinymce.min.js')}}"></script>
	<script src="{{URL::asset('admin_assets/plugins/tinymce/langs/ar.js')}}"></script>
    <script>
        $(function() {
            'use strict'

            $('.fc-datepicker').datepicker({
                dateFormat: 'yy-mm-dd',
                showOtherMonths: true,
                selectOtherMonths: true
            });

			$('#bg_color').spectrum({
				allowEmpty: true,
				color: null,
				preferredFormat: "rgba",
				change: function(color) {
					$(this).closest('col-lg').find('#bg_color').val(color.toHex());
				}
			});

			tinymce.init({
				selector: 'textarea.contract_textarea', // change this according to your HTML
				language: 'ar',
				height : "400",
				directionality : 'rtl',
				plugins: 'lists',
				toolbar: [
					{ name: 'history', items: [ 'undo', 'redo' ] },
					{ name: 'styles', items: [ 'styles' ] },
					{ name: 'formatting', items: [ 'bold', 'italic' ] },
					{ name: 'alignment', items: [ 'alignleft', 'aligncenter', 'alignright', 'alignjustify' ] },
					{ name: 'indentation', items: [ 'outdent', 'indent' ] },
					{ name: 'lists', items: [ 'numlist', 'bullist' ] }
				],
			});
        });

		// Prevent Bootstrap dialog from blocking focusin
		$(document).on('focusin', function(e) {
			if ($(e.target).closest(".mce-window, .tox-tinymce, .tox-tinymce-aux, .moxman-window, .tam-assetmanager-root").length) {
				e.stopImmediatePropagation();
			}
		});
    </script>
@endsection
