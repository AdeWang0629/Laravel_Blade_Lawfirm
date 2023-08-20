<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountSettingsRequest;
use App\Models\CaseSession;
use App\Models\Client;
use App\Models\Consultation;
use App\Models\Lawsuite;
use App\Models\Receipt;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $data = [
            'lawsuites' => Lawsuite::orderBy('contract_date', 'desc')->get()->take(6),
            'lawsuitesCount' => Lawsuite::count(),
            'consultationsCount' => Consultation::count(),
            'clientsCount' => Client::count(),
            'caseSessionCount' => CaseSession::count(),
            'receipts' => Receipt::orderBy('date', 'desc')->get(['title','debit', 'lawsuite_id', 'consultation_id'])->take(6),
            'lawsuitesPayments' => Receipt::whereNull('consultation_id')->sum('debit'),
            'consultationPayments' => Receipt::whereNull('lawsuite_id')->sum('debit'),
        ];

        // dd($data);
        return view('admin.index', $data);
    }

    public function profile()
    {
        return view('admin.account_settings.index');
    }

    public function profileUpdate(AccountSettingsRequest $request)
    {
        try {
            $data = $request->only('first_name','last_name','email','user_name');
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
}
