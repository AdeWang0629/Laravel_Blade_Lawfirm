<?php

namespace App\Repository;

use App\Models\Client;
use App\Models\ClientAccount;
use App\Models\Consultation;
use App\Repository\ConsultationRepositoryInterface;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Stevebauman\Purify\Facades\Purify;

class ConsultationRepository implements ConsultationRepositoryInterface {
    public function index()
    {
        $consultations = Consultation::with('client', 'clientAccounts')->when(request('client') != '', function($q) {
            return $q->whereClientId(request('client'));
        })->orderBy('id', 'desc')->get();
        return view('admin.consultations.index', compact('consultations'));
    }

    public function show($consultation)
    {
        $receipts = $consultation->receipts;
        return view('admin.consultations.show', compact('consultation','receipts'));
    }

    public function create()
    {
        $clients = Client::all();
        return view('admin.consultations.create', compact('clients'));
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $consultations = Consultation::create([
                'client_id'                     => $request->client_id,
                'consultation_number'           => Purify::clean(consultationNumber()),
                'consultation_subject'          => Purify::clean($request->consultation_subject),
                'contract_amount'               => Purify::clean($request->contract_amount),
                'base_encode'                   => base64_encode(consultationNumber().\Illuminate\Support\Str::random(40)),
                'vat'                           => Purify::clean($request->vat),
                'total_amount'                  => Purify::clean($request->total_amount),
                'contract_date'                 => Purify::clean($request->contract_date),
                'contract_terms'                => Purify::clean($request->contract_terms),
            ]);

            ClientAccount::create([
                'type'              => 'consultation_payment',
                'client_id'         => $request->client_id,
                'consultation_id'   => $consultations->id,
                'credit'            => 0.00,
                'debit'             => Purify::clean($request->total_amount)
            ]);

            DB::commit();
            toast(trans('site.created successfully', ['attr' => trans_choice('site.consultations', 0)]),'success');
            return to_route('admin.consultations.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($consultation)
    {
        $clients = Client::all();
        return view('admin.consultations.edit', compact('consultation','clients'));
    }

    public function update($request, $consultation)
    {
        DB::beginTransaction();
        try {
            $consultation->update([
                'client_id'                     => $request->client_id,
                'consultation_subject'          => Purify::clean($request->consultation_subject),
                'contract_amount'               => Purify::clean($request->contract_amount),
                'vat'                           => Purify::clean($request->vat),
                'total_amount'                  => Purify::clean($request->total_amount),
                'contract_date'                 => Purify::clean($request->contract_date),
                'contract_terms'                => Purify::clean($request->contract_terms),
            ]);
            $consultation->clientAccounts->each(function($item, $key) use($request){
                if ($item->type == 'consultation_payment') {
                    $item->update([
                        'client_id'     => $request->client_id,
                        'debit'         => Purify::clean($request->total_amount)
                    ]);
                }

                if ($item->type == 'receipt_payment') {
                    $item->update([
                        'client_id'     => $request->client_id,
                    ]);
                }

                return $item;
            });

            $consultation->receipts->whereNotNull('consultation_id')->each(function($item, $key) use($request){
                $item->update([
                    'client_id'     => $request->client_id,
                ]);
            });

            DB::commit();
            toast(trans('site.updated successfully', ['attr' => trans_choice('site.consultations', 0)]),'success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function delete($consultation)
    {
        $consultation->delete();
        toast(trans('site.deleted successfully', ['attr' => trans_choice('site.consultations', 0)]),'success');
        return to_route('admin.consultations.index');
    }

    public function showContract($id)
    {
        $consultation = Consultation::where('id', $id)->with(['client'])->first();
        $qr_code = QrCode::generate(route('admin.show.qr.consultation.contract', $consultation->base_encode));
        return view('layouts.admin.consultation', compact('consultation', 'qr_code'));
    }

    public function qrContract($base_encode)
    {
        $consultation = Consultation::where('base_encode', $base_encode)->with(['client'])->first();
        $qr_code = QrCode::generate(route('admin.show.qr.consultation.contract', $consultation->base_encode));
        return view('layouts.admin.qr_consultation', compact('consultation', 'qr_code'));
    }
}
