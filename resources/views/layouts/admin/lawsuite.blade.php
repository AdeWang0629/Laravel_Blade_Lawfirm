@extends('layouts.admin.master')

@section('title', trans('site.lawsuite_contract_num_attr', ['attr'=> $lawsuite->case_number]))

@section('css')
    <style>
        body {
            direction: rtl;
            background: #FFFFFF !important;
        }
        .header-top p {
            font-size: 15px;
        }
        .invoice-title {
            color: #00247b !important;
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
            .header-top p {
                font-size: 15pt;
            }
            .invoice-title {
                color: #00247b !important;
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
			<h4 class="content-title mb-0 my-auto">{{ trans('site.home') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('site.lawsuite_contract_num_attr', ['attr'=> $lawsuite->case_number]) }}</span>
		</div>
	</div>
    @canany(['lawsuite_edit', 'lawsuite_list'])
        <div class="d-flex my-xl-auto right-content">
            @can('lawsuite_edit')
                <div class="pr-1 mb-3 mb-xl-0">
                    <a href="{{ route('admin.lawsuites.edit', $lawsuite) }}" class="btn btn-sm btn-primary">{{ trans('site.edit', ['attr' => trans_choice('site.lawsuites', 0)]) }} <i class="fas fa-edit"></i></a>
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
                                <div class="text-center d-block">
                                    <h1 class="invoice-title">{{ $lawsuite->contract_title ?? getSettingOf('contract_title') }}</h1>
                                </div><!-- invoice-header -->
                                <div class="row mg-t-20 header-top">
                                    <div class="col-md text-right w-50">
                                        <p class="tx-gray-600">{{ trans('site.date_attr', ['attr' => trans_choice('site.contracts', 0)]) }}: {{ $lawsuite->contract_date->format('d-m-Y') }}</p>
                                    </div>
                                    <div class="col-md text-left w-50">
                                        <p class="tx-gray-600">{{ trans('site.lawsuite_number') }}: {{ $lawsuite->case_number }}</p>
                                    </div>
                                </div>
                                <div class="row mg-b-20">
                                    <div class="col-md">
                                        <label class="tx-gray-600">{{ trans('site.its_on') }} {{ $lawsuite->contract_date->translatedFormat('l').' '.trans('site.mowafic').' '.$lawsuite->contract_date->format('d/ m / Y') }} م</label>
                                        <div class="billed-to">
                                            <h6>{{ trans('site.it_was_agreed_between') }}:</h6>
                                            <p>أولاً: السيد/ {{ getSettingOf('office_name') ?? '………' }} وعنوانه : {{ getSettingOf('office_address') ?? '………' }} ويمثلة فى هذا العقد {{ getSettingOf('office_owner') ?? '………' }} المحامى بصفتة صاحب المكتب  ,بريد الكترونى {{ getSettingOf('email') ?? '………' }} ,هاتف {{ getSettingOf('mobile') ?? '………' }} <span>({{ trans('site.the_first_party') }})</span></p>
                                            <p>ثانياً: السيد/ {{ $lawsuite->client->name ?? '………' }} وجنسيته {{ $lawsuite->client->nationality ?? '………' }} ويحمل بطاقة/ جواز سفر رقم {{ $lawsuite->client->id_number ?? '………' }} والمقيم في {{ $lawsuite->client->address ?? '………' }}  ,بريد الكترونى {{ $lawsuite->client->email ?? '………' }}, هاتف {{ $lawsuite->client->mobile ?? '………' }}<span>({{ trans('site.the_second_party') }})</span></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mg-t-20">
                                    <div class="col-md">
                                        <div class="billed-to">
                                            <h6>{{ trans('site.after_two_parties_acknowledged') }}:</h6>
                                            <div class="con_content">
                                                {!! $lawsuite->contract_terms !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mg-t-20">
                                    <div class="col-md text-center w-50">
                                        <label class="tx-gray-600">{{ trans('site.the_first_party') }} <br> <span class="font-weight-bold tx-gray-900"> {{ getSettingOf('office_name') }}</span></label>
                                        <p>-------------------</p>
                                    </div>
                                    <div class="col-md text-center w-50">
                                        <label class="tx-gray-600">{{ trans('site.the_second_party') }} <br> <span class="font-weight-bold tx-gray-900">{{ $lawsuite->client->name }}</span></label>
                                        <p>-------------------</p>
                                    </div>
                                </div>
                                <div class="text-center">
                                    {!! $qr_code !!}
                                </div>
                            </div>

                            <hr class="mg-b-40">
                            <button class="btn btn-danger float-left mt-3 mr-2 print_this"> <i class="mdi mdi-printer ml-1"></i>{{ trans('site.print_contract') }}</button>
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
