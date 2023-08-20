@extends('layouts.admin.master')

@section('title',  trans_choice('site.newspapers', 0).' '.$lawsuites_paper->title.' '.trans('site.of_case_attr', ['attr' => $lawsuites_paper->lawsuite->case_number]))

@section('css')
    <style>
        body {
            direction: rtl;
            background: #FFFFFF !important;
        }
        .myDivToPrint {
            font-size: 18px !important;
            padding: 23px;
        }
        label {
            margin-bottom: 1.5rem !important;
        }
        .billed-to h6 {
            font-size: 21px !important;
            margin-bottom: 1.5rem !important;
        }
        .billed-to p {
            font-size: 16px !important;
            margin-bottom: 18px !important;
        }
        .billed-to p span{
            font-weight: bold !important;
            float: left;
        }
        .con_content h1, .con_content h2, .con_content h3, 
        .con_content h4, .con_content h5, .con_content h6 {
            font-weight: bold !important;
            margin-top: 2rem !important;
            text-align: center;
            margin-bottom: 1rem;
        }
        .invoice-header img{
            margin-bottom: 1.5rem;
        }
        @media print {
            body {
                direction: rtl;
                background: #FFFFFF !important;
            }
            .myDivToPrint {
                font-size: 20pt !important;
                padding: 25px;
            }
            label {
                margin-bottom: 1.5rem !important;
            }
            .billed-to h6 {
                font-size: 23pt !important;
                margin-bottom: 2.5rem !important;
            }
            .billed-to p {
                font-size: 18pt !important;
                margin-bottom: 20pt !important;
            }
            .billed-to p span{
                font-weight: bold !important;
                float: left;
            }
            .con_content h1, .con_content h2, .con_content h3, 
            .con_content h4, .con_content h5, .con_content h6 {
                font-weight: bold !important;
                margin-top: 2rem !important;
                text-align: center;
                margin-bottom: 1rem;
            }
            .invoice-header img{
                margin-bottom: 1.5rem;
            }
        }
    </style>
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
			<h4 class="content-title mb-0 my-auto">{{ trans('site.home') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {!! trans_choice('site.newspapers', 0).' <span class="text-danger font-weight-bold">('.$lawsuites_paper->title.')</span> '.trans('site.of_case_attr', ['attr' => $lawsuites_paper->lawsuite->case_number]) !!}</span>
		</div>
	</div>
    @canany(['lawsuite_edit', 'lawsuite_list'])
        <div class="d-flex my-xl-auto right-content">
            @can('lawsuite_edit')
                <div class="pr-1 mb-3 mb-xl-0">
                    <a href="{{ route('admin.lawsuites.edit', $lawsuites_paper->lawsuite_id) }}" class="btn btn-sm btn-primary">{{ trans('site.edit', ['attr' => trans_choice('site.lawsuites', 0)]) }} <i class="fas fa-edit"></i></a>
                </div>
            @endcan

            @can('lawsuite_list')
                <div class="pr-1 mb-3 mb-xl-0">
                    <a href="{{ route('admin.lawsuites.index') }}" class="btn btn-sm btn-success">{{ trans('site.all_attr', ['attr' => trans_choice('site.lawsuites', 1)]) }} <i class="fas fa-long-arrow-alt-left"></i></a>
                </div>
            @endcan
        </div>
    @endcan
</div>
<!-- breadcrumb -->
@endsection
@section('content')
            <div class="row row-sm">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
                    <div class="card card-invoice">
                        <div class="card-body">
                            <div class="myDivToPrint">
                                <div class="invoice-header">
                                    <img src="{{ getSettingOf('receipt_header') ? asset('images/settings/receipt-header/'.getSettingOf('receipt_header')) : asset('admin_assets/img/headercompany.jpg') }}" class="w-100" />
                                </div>
                                <div class="row row-sm">
                                    <div class="col-xl-9 w-75">
                                        <div class="row mg-b-20">
                                            <div class="col-md">
                                                <label class="tx-gray-600">{{ trans('site.its_on') }} {{ $lawsuites_paper->date->translatedFormat('l') }} الموافق {{ $lawsuites_paper->date->format('d/ m / Y') }} م</label>
                                                <div class="billed-to">
                                                    <p>بناء على طلب السيد/ {{ $lawsuites_paper->lawsuite->client->name ?? '………………………………………' }} والمقيم {{ $lawsuites_paper->lawsuite->client->address ?? '………………………………………' }} ومحله المختار مكتب الاستاذ/ {{ getSettingOf('office_owner') ?? '………' }} المحامى والكائن فى {{ getSettingOf('office_address') ?? '………' }} انا …………………………………………………… محضر محكمة …………………………………………… الجزئية قد انتقلت فى التاريخ المذكور اعلاه وأعلنت:</p>
                                                    @foreach ($lawsuites_paper->lawsuite->opponents as $opponent)
                                                        <p>{{ $loop->iteration }}-السيد/ {{ $opponent->opponent_name ?? '………………………………………' }} والمقيم {{ $opponent->opponent_address ?? '………………………………………' }} قسم {{ $opponent->opponent_section ?? '………………………………………' }} محافظة {{ $opponent->opponent_city ?? '………………………………………' }} مخاطباً مع/ ………………………</p>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mg-t-20">
                                            <div class="col-md">
                                                <div class="billed-to">
                                                    <h6>وأعلنته بالأتى:</h6>
                                                    <div class="con_content">
                                                        {!! $lawsuites_paper->subject !!}
                                                        <p>بناء عليه,,,,,</p>
                                                        {!!  $lawsuites_paper->based_on_it !!}
                                                        <p>ولأجل العلم / </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 w-25 text-center border-right border-dark">
                                        <div class="row mg-b-60 mg-t-20">
                                            <div class="col-md">
                                                <div class="billed-to">
                                                    <h6>الموضوع</h6>
                                                    <p>{{ $lawsuites_paper->title }}</p>
                                                    <p>كطلب الطالب وتحت مسئوليته</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md">
                                                <div class="billed-to">
                                                    <h6>وكيل الطالب</h6>
                                                    <p>.............</p>
                                                    <p>المحامى</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="mg-b-40">
                            <button class="btn btn-danger float-left mt-3 mr-2 print_this"> <i class="mdi mdi-printer ml-1"></i>طباعة</button>
                        </div>
                    </div>
                </div><!-- COL-END -->
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{URL::asset('admin_assets/plugins/printThis.js')}}"></script>
    <script>
        $(function() {
            'use strict'
            $("#global-loader").fadeOut("slow");
            $('.print_this').on('click', function() {
                $('.myDivToPrint').printThis({
                    importCSS: true,            // import parent page css
                    importStyle: true,         // import style tags
                });
            })
        });	
    </script><!-- Left-menu js-->
@endsection