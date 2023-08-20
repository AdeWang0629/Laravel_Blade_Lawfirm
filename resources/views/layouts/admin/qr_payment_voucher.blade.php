@extends('layouts.admin.master3')

@section('title', trans('site.receipt_number', ['attr'=> $payment->voucher_number]))

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
        .myDivToPrint table td {
            vertical-align: top;
            line-height: 1;
            width: 200pt;
            font-size: 15px
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
            .myDivToPrint table td {
                vertical-align: top;
                line-height: 1;
                width: 200pt;
                font-size: 15px
            }
            .w-20 {
                width: 20%;
            }
            .w-40 {
                width: 40%;
            }
            @page { size: landscape; }
        }
    </style>
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ trans('site.home') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('site.lawsuite_contract_num_attr', ['attr'=> $payment->voucher_number]) }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    <div class="container mt-10">
        <div class="justify-content-center row row-sm">
            <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 grid-margin mt-2">
                        <div class="card card-invoice">
                            <div class="card-body">
                                <div class="myDivToPrint">
                                    <div class="invoice-header">
                                        <img src="{{ getSettingOf('receipt_header') ? asset('images/settings/receipt-header/'.getSettingOf('receipt_header')) : asset('admin_assets/img/headercompany.jpg') }}" class="w-100" />
                                    </div>
                                    <div class="row mg-t-20 header-top">
                                        <div class="col-md text-center w-100">
                                            <p class="tx-gray font-weight-bold tx-16-f">سند صرف - Payment voucher</p>
                                            <p class="tx-gray font-weight-bold tx-16-f">{{ $payment->branch->name }} - {{ $payment->expenseSection->name }}</p>
                                        </div>
                                    </div>
                                    <div class="row mg-t-20 header-top">
                                        <div class="col-md text-right  w-40">
                                            <p class="tx-gray-900 mb-0">{{ trans('site.receipt_date') }}: {{ $payment->date }}</p>
                                        </div>
                                        <div class="col-md text-center w-20">
                                            <p class="font-weight-bold tx-20-f text-danger mb-0">{{ $payment->voucher_number }}</p>
                                        </div>
                                        <div class="col-md text-left  w-40">
                                            <p class="tx-gray-900 mb-0">{{ trans('site.vat_registration_number') }}: {{ getSettingOf('vat_registration_number') }}</p>
                                        </div>
                                    </div>

                                    <div class="mg-t-20">
                                        <table class="table table-bordered" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td class="text-right">صرفنا الى السيد</td>
                                                <td class="text-center font-weight-bold">{{ $payment->receiver }}</td>
                                                <td class="text-left">Spent to Mr</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">مبلغ وقدرة</td>
                                                <td class="text-center font-weight-bold">{{ $payment->debit }}</td>
                                                <td class="text-left">Amount of</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">طريقة الدفع</td>
                                                <td class="text-center font-weight-bold">{{ $payment->payment_type }}</td>
                                                <td class="text-left">Payment method</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">وذلك عن</td>
                                                <td class="text-center font-weight-bold">{{ $payment->note }}</td>
                                                <td class="text-left">That's about</td>
                                            </tr>
                                        </table>
                                    </div>

                                    
                                    <div class="row mg-t-20">
                                        <div class="col-md text-center w-50">
                                            <label class="font-weight-bold tx-gray-900">التوقيع</label>
                                            <p>-------------------</p>
                                        </div>
                                        <div class="col-md text-center w-50">
                                            <label class="font-weight-bold tx-gray-900">الختم</label>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        {!! $qr_code !!}
                                    </div>
                                </div>

                                <button class="btn btn-danger float-left mt-3 mr-2 print_this"> <i class="mdi mdi-printer ml-1"></i>{{ trans('site.print_contract') }}</button>
                            </div>
                        </div>
                    </div><!-- COL-END -->
                </div>
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