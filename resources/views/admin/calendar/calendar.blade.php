@extends('layouts.admin.master')

@section('title', trans('site.calendar'))

@section('css')
<!-- Internal fullcalendar Css-->
<link href="{{URL::asset('admin_assets/plugins/fullcalendar/fullcalendar.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
			<h4 class="content-title mb-0 my-auto">{{ trans('site.home') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('site.calendar') }}</span>
		</div>
	</div>
	@can('lawsuites_list')
		<div class="d-flex my-xl-auto right-content">
			<div class="pr-1 mb-3 mb-xl-0">
				<a href="{{ route('admin.lawsuites.index') }}" class="btn btn-sm btn-success">{{ trans('site.all_attr', ['attr' => trans_choice('site.lawsuites', 1)]) }} <i class="fas fa-long-arrow-alt-left"></i></a>
			</div>
		</div>
	@endcan
</div>
<!-- breadcrumb -->
@endsection
@section('content')
				<div class="main-content-app pd-b-0  main-content-calendar pt-0">
					<!-- row -->
					<div class="row row-sm">
						<div class="col-lg-12 col-xl-12">
							<div class="main-content-body main-content-body-calendar card p-4">
								<div class="main-calendar" id="calendar"></div>
							</div>
						</div>
					</div>
					<!-- /row -->
				</div>
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!-- moomet min js -->
<script src="{{URL::asset('admin_assets/plugins/moment/min/moment.min.js')}}"></script>
<!--Internal  Date picker js -->
<script src="{{URL::asset('admin_assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!--Internal  Fullcalendar js -->
<script src="{{URL::asset('admin_assets/plugins/fullcalendar/fullcalendar.min.js')}}"></script>
<script src="{{URL::asset('admin_assets/plugins/fullcalendar/locale/ar.js')}}"></script>
<!-- Internal Select2.full.min js -->
<script src="{{URL::asset('admin_assets/plugins/select2/js/select2.full.min.js')}}"></script>
<!--Internal App calendar js -->
<script>
	$(function() {
		'use strict'
		var curYear = moment().format('YYYY');
		var curMonth = moment().format('MM');
	
		$('#calendar').fullCalendar({
			header: {
				left: 'next,prev today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay,listWeek'
			},
			navLinks: true,
			selectable: true,
			selectLongPressDelay: 100,
			editable: true,
			nowIndicator: true,
			defaultView: 'listMonth',
			@can('caseSession_show')
				events: @json($caseSessions),
			@endcan
			locale: 'ar'
		});
		var azCalendar = $('#calendar').fullCalendar('getCalendar');
		// change view to week when in tablet
		if (window.matchMedia('(min-width: 576px)').matches) {
			azCalendar.changeView('agendaWeek');
		}
		// change view to month when in desktop
		if (window.matchMedia('(min-width: 992px)').matches) {
			azCalendar.changeView('month');
		}
		// change view based in viewport width when resize is detected
		azCalendar.option('windowResize', function(view) {
			if (view.name === 'listWeek') {
				if (window.matchMedia('(min-width: 992px)').matches) {
					azCalendar.changeView('month');
				} else {
					azCalendar.changeView('listWeek');
				}
			}
		});
	})
</script>
@endsection