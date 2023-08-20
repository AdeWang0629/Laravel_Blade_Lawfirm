<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountSettingsRequest;
use App\Models\Consultation;
use App\Models\Lawsuite;
use App\Models\Receipt;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ClientController extends Controller
{
    public function dashboard()
    {
        return view('admin.clients.dashboard.dashboard');
    }

    public function profile()
    {
        return view('admin.account_settings.index');
    }

    public function profileUpdate(AccountSettingsRequest $request)
    {
        try {
            $data = $request->only('name','email','user_name');
            if ($request->password && $request->password != null) {
                $data['password'] = bcrypt($request->password); 
            }

            auth()->user()->update($data);

            toast(trans('site.updated successfully', ['attr' => trans('site.account')]), 'success');
            return back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function showLawsuite($id)
    {
        $lawsuite = Lawsuite::whereClientId(auth()->id())->findOrFail($id);
        return view('admin.clients.dashboard.lawsuites', compact('lawsuite'));
    }

    public function showConsultation($id)
    {
        $consultation = Consultation::whereClientId(auth()->id())->findOrFail($id);
        $receipts = $consultation->receipts;    
        return view('admin.clients.dashboard.consultations', compact('consultation', 'receipts'));
    }
    
    public function qrLawsuitesContract($base_encode)
    {
        $lawsuite = Lawsuite::where('base_encode', $base_encode)->with(['client'])->first();
        $qr_code = QrCode::generate(route('admin.show.qr.contract', $lawsuite->base_encode));
        return view('layouts.admin.qr_lawsuite', compact('lawsuite', 'qr_code'));
    }

    public function qrConsultationContract($base_encode)
    {
        $consultation = Consultation::where('base_encode', $base_encode)->with(['client'])->first();
        $qr_code = QrCode::generate(route('admin.show.qr.consultation.contract', $consultation->base_encode));
        return view('layouts.admin.qr_consultation', compact('consultation', 'qr_code'));
    }

    public function qrReceipt($base_encode)
    {
        $receipt = Receipt::where('base_encode', $base_encode)->with('client','clientAccount','lawsuite','consultation')->first();
        $qr_code = QrCode::generate(route('admin.show.qr.receipt', $receipt->base_encode));
        return view('layouts.admin.qr_receipt', compact('receipt', 'qr_code'));
    }
}
