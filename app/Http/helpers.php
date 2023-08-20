<?php

use App\Models\Consultation;
use App\Models\Lawsuite;
use App\Models\Payment;
use App\Models\Receipt;
use Illuminate\Support\Facades\DB;
use Spatie\Valuestore\Valuestore;

if (!function_exists('lawsuiteCaseNumber')) {
    function lawsuiteCaseNumber()
    { //Get last lawsuite number
        $last_lawsuite = Lawsuite::orderBy('id', 'desc')->first();
        if (!$last_lawsuite) {
            return $lawsuite_num = 'LAW001';
        }
        $lawsuite_num = preg_replace("/[^0-9\.]/", '', $last_lawsuite->case_number);
        return $lawsuite_num = 'LAW' . sprintf('%03d', $lawsuite_num + 1);
    }
}

if (!function_exists('consultationNumber')) {
    function consultationNumber()
    { //Get last consultation number
        $last_consultation = Consultation::orderBy('id', 'desc')->first();
        if (!$last_consultation) {
            return $consultation_num = 'CON001';
        }
        $consultation_num = preg_replace("/[^0-9\.]/", '', $last_consultation->consultation_number);
        return $consultation_num = 'CON' . sprintf('%03d', $consultation_num + 1);
    }
}

if (!function_exists('receiptNumber')) {
    function receiptNumber()
    { //Get last consultation number
        $last_receipt = Receipt::orderBy('id', 'desc')->first();
        if (!$last_receipt) {
            return $last_receipt = 'INVOICE001';
        }
        $last_receipt = preg_replace("/[^0-9\.]/", '', $last_receipt->receipt_number);
        return $last_receipt = 'INVOICE' . sprintf('%03d', $last_receipt + 1);
    }
}
if (!function_exists('voucherNumber')) {
    function voucherNumber()
    { //Get last consultation number
        $last_voucher = Payment::orderBy('id', 'desc')->first();
        if (!$last_voucher) {
            return $last_voucher = 'VOUCHER001';
        }
        $last_voucher = preg_replace("/[^0-9\.]/", '', $last_voucher->voucher_number);
        return $last_voucher = 'VOUCHER' . sprintf('%03d', $last_voucher + 1);
    }
}

if (!function_exists('whatsappLink')) {
    function whatsappLink($phonenumb, $msg)
    {
        $iphone     = strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone');
        $android    = strpos($_SERVER['HTTP_USER_AGENT'], 'Android');
        $berry      = strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry');
        $ipod       = strpos($_SERVER['HTTP_USER_AGENT'], 'iPod');
        $ipad       = strpos($_SERVER['HTTP_USER_AGENT'], 'iPad');
        $webOS      = strpos($_SERVER['HTTP_USER_AGENT'], 'webOS');
        $silk       = strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/');
        $kindle     = strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle');
        $opera      = strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini');
        $mobi       = strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mobi');
        if ($iphone || $android || $berry || $ipod || $ipad || $webOS || $silk || $kindle || $opera || $mobi == true) {
            $wa_base = 'api';
        } else {
            $wa_base = 'web';
        }

        return 'https://' . $wa_base . '.whatsapp.com/send?phone=' . $phonenumb . '&text=' . $msg;
    }
}

if (! function_exists('removebeginninLetters')) {
    function removebeginninLetters($word, $letters_num) {
        if (config('app.locale') == 'ar') {
            return mb_substr($word, $letters_num, null,'utf-8');
        }else {
            return $word;
        }
    }
}

if (! function_exists('getSettingOf')) {
    function getSettingOf($key) {
        $valuestore = Valuestore::make(config_path('seeting.json'));
        return $valuestore->get($key);
    }
}

if (! function_exists('calculateVat')) {
    function calculateVat($number, $vat) {
        return ($number / 100) * $vat;
    }
}

if (! function_exists('currency_details')) {
    function currency_details($mount) {
        if (getSettingOf('currency_direction') == 0) {
            return $mount.' '.(getSettingOf('currency') ?? 'جنية');
        }else {
            return (getSettingOf('currency') ?? 'جنية').' '.$mount;
        }
    }
}

if (! function_exists('getGravatar')) {
    function getGravatar($email, $size) {
        $hash = md5( strtolower( trim( $email ) ) );
        return "https://www.gravatar.com/avatar/" . $hash . "?s=" . $size;
    }
}

if (! function_exists('CopyRight')) {
    function CopyRight() {
        $copyrightStartDate = DB::table('lawsuites')->select(DB::raw('Year(created_at) as year'))
        ->groupBy(DB::raw('Year(created_at)'))
        ->pluck('year')->first();

        if($copyrightStartDate) {
            $copyright = "<span>".trans('site.copyright')." © ". $copyrightStartDate . " <b>" .request()->getHost()."</b> ".trans('site.designed_by')." <a href='https://www.facebook.com/developer.mohamedfawzy/'>Muhamemed Fawzy</a> ".trans('site.all_rights_reserved')."</span>";
        }

        return $copyright;
    }
}


