<?php

namespace App\Repository;

use App\Models\LawsuitCase;
use App\Models\CaseStage;
use App\Models\CaseType;
use App\Models\Client;
use App\Models\ClientAccount;
use App\Models\ClientType;
use App\Models\Court;
use App\Models\Lawsuite;
use App\Repository\LawsuiteRepositoryInterface;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Stevebauman\Purify\Facades\Purify;

class LawsuiteRepository implements LawsuiteRepositoryInterface {

    public function index()
    {
        $lawsuites = Lawsuite::withCount('caseSessions')
        ->when(request('client-type') != '', function($q) {
            return $q->whereClientTypeId(request('client-type'));
        })->when(request('client') != '', function($q) {
            return $q->whereClientId(request('client'));
        })->when(request('court') != '', function($q) {
            return $q->whereCourtId(request('court'));
        })->when(request('lawsuitCase') != '', function($q) {
            return $q->whereLawsuitCaseId(request('lawsuitCase'));
        })->when(request('case-stage') != '', function($q) {
            return $q->whereCaseStageId(request('case-stage'));
        })->when(request('case-type') != '', function($q) {
            return $q->whereCaseTypeId(request('case-type'));
        })->orderBy('id', 'desc')->get();
        return view('admin.lawsuites.index', compact('lawsuites'));
    }

    public function show($lawsuite)
    {
        return view('admin.lawsuites.show', compact('lawsuite'));
    }

    public function create()
    {
        $clients = Client::all();
        $clientTypes = ClientType::all();
        $caseTypes = CaseType::all();
        $caseStages = CaseStage::all();
        $lawsuiteCases = LawsuitCase::all();
        $courts = Court::all();
        return view('admin.lawsuites.create', compact('clients','clientTypes','caseTypes','caseStages','lawsuiteCases','courts'));
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $lawsuite = Lawsuite::create([
                'client_id'                 => $request->client_id,
                'client_type_id'            => $request->client_type_id,
                'case_type_id'              => $request->case_type_id,
                'lawsuite_lawyer'           => Purify::clean($request->lawsuite_lawyer),
                'lawsuite_subject'          => Purify::clean($request->lawsuite_subject),
                'case_stage_id'             => $request->case_stage_id,
                'lawsuit_case_id'           => $request->lawsuit_case_id,
                'court_id'                  => $request->court_id,
                'case_number'               => lawsuiteCaseNumber(),
                'base_encode'               => base64_encode(lawsuiteCaseNumber().\Illuminate\Support\Str::random(40)),
                'court_case_number'         => Purify::clean($request->court_case_number),
                'contract_title'            => Purify::clean($request->contract_title),
                'contract_date'             => Purify::clean($request->contract_date),
                'contract_amount'           => Purify::clean($request->contract_amount),
                'vat'                       => Purify::clean($request->vat),
                'total_amount'              => Purify::clean($request->total_amount),
                'contract_terms'            => Purify::clean($request->contract_terms),
                'notes'                     => Purify::clean($request->notes),
            ]);

            foreach ($request->opponents as $opponent) {
                $lawsuite->opponents()->create([
                    'opponent_name'             => Purify::clean($opponent['opponent_name']),
                    'opponent_phone'            => Purify::clean($opponent['opponent_phone']),
                    'opponent_city'             => Purify::clean($opponent['opponent_city']),
                    'opponent_section'          => Purify::clean($opponent['opponent_section']),
                    'opponent_address'          => Purify::clean($opponent['opponent_address']),
                    'opponent_lawyer'           => Purify::clean($opponent['opponent_lawyer']),
                    'opponent_lawyer_phone'     => Purify::clean($opponent['opponent_lawyer_phone']),
                ]);
            }

            ClientAccount::create([
                'type'          => 'lawsuite_payment',
                'client_id'     => $request->client_id,
                'lawsuite_id'   => $lawsuite->id,
                'credit'        => 0.00,
                'debit'         => Purify::clean($request->total_amount)
            ]);

            DB::commit();
            toast(trans('site.created successfully', ['attr' => trans_choice('site.lawsuites', 0)]),'success');
            return to_route('admin.lawsuites.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($lawsuite)
    {
        $clients = Client::all();
        $clientTypes = ClientType::all();
        $caseTypes = CaseType::all();
        $caseStages = CaseStage::all();
        $lawsuiteCases = LawsuitCase::all();
        $courts = Court::all();
        $lawsuiteOpponents = $lawsuite->opponents->map(function ($item, $key) {
            return [
                'opponent_name' => $item->opponent_name,
                'opponent_phone' => $item->opponent_phone,
                'opponent_city' => $item->opponent_city,
                'opponent_section' => $item->opponent_section,
                'opponent_address' => $item->opponent_address,
                'opponent_lawyer' => $item->opponent_lawyer,
                'opponent_lawyer_phone' => $item->opponent_lawyer_phone
            ];
        });
        return view('admin.lawsuites.edit', compact('lawsuite','clients','clientTypes','caseTypes','caseStages','lawsuiteCases','courts','lawsuiteOpponents'));
    }

    public function update($request, $lawsuite)
    {
        DB::beginTransaction();
        try {
            $lawsuite->update([
                'client_id'                 => $request->client_id,
                'client_type_id'            => $request->client_type_id,
                'case_type_id'              => $request->case_type_id,
                'lawsuite_lawyer'           => Purify::clean($request->lawsuite_lawyer),
                'lawsuite_subject'          => Purify::clean($request->lawsuite_subject),
                'case_stage_id'             => $request->case_stage_id,
                'lawsuit_case_id'           => $request->lawsuit_case_id,
                'court_id'                  => $request->court_id,
                'court_case_number'         => Purify::clean($request->court_case_number),
                'contract_title'            => Purify::clean($request->contract_title),
                'contract_date'             => Purify::clean($request->contract_date),
                'contract_amount'           => Purify::clean($request->contract_amount),
                'vat'                       => Purify::clean($request->vat),
                'total_amount'              => Purify::clean($request->total_amount),
                'contract_terms'            => Purify::clean($request->contract_terms),
                'notes'                     => Purify::clean($request->notes),
            ]);

            if ($request->opponents) {
                $lawsuite->opponents()->delete();

                foreach ($request->opponents as $opponent) {
                    $lawsuite->opponents()->create([
                        'lawsuite_id'               => $lawsuite->id,
                        'opponent_name'             => Purify::clean($opponent['opponent_name']),
                        'opponent_phone'            => Purify::clean($opponent['opponent_phone']),
                        'opponent_city'             => Purify::clean($opponent['opponent_city']),
                        'opponent_section'          => Purify::clean($opponent['opponent_section']),
                        'opponent_address'          => Purify::clean($opponent['opponent_address']),
                        'opponent_lawyer'           => Purify::clean($opponent['opponent_lawyer']),
                        'opponent_lawyer_phone'     => Purify::clean($opponent['opponent_lawyer_phone']),
                    ]);
                }
            }

            $lawsuite->clientAccounts->each(function($item, $key) use($request){
                if ($item->type == 'lawsuite_payment') {
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

            $lawsuite->receipts->whereNotNull('lawsuite_id')->each(function($item, $key) use($request){
                $item->update([
                    'client_id'     => $request->client_id,
                ]);
            });

            DB::commit();
            toast(trans('site.updated successfully', ['attr' => trans_choice('site.lawsuites', 0)]),'success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function delete($lawsuite)
    {
        $lawsuite->delete();
        toast(trans('site.deleted successfully', ['attr' => trans_choice('site.lawsuites', 0)]),'success');
        return redirect()->back();
    }

    public function lawsuitesStatus($id)
    {
        $lawsuites = Lawsuite::withCount('caseSessions')->where('lawsuit_case_id', $id)->get();
        return view('admin.lawsuites.index', compact('lawsuites'));
    }

    public function judgmentUpdate($request, $lawsuite)
    {
        try {
            $request->validate([
                'judgment' => 'required|string',
            ],[],[
                'judgment' => trans_choice('site.judgments', 0)
            ]);

            $lawsuite->update([
                'judgment' => Purify::clean($request->judgment)
            ]);

            toast(trans('site.updated successfully', ['attr' => trans_choice('site.lawsuites', 0)]),'success');
            return to_route('admin.lawsuites.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function showContract($id)
    {
        $lawsuite = Lawsuite::where('id', $id)->with(['client'])->first();
        $qr_code = QrCode::generate(route('admin.show.qr.contract', $lawsuite->base_encode));
        return view('layouts.admin.lawsuite', compact('lawsuite', 'qr_code'));
    }

    public function qrContract($base_encode)
    {
        $lawsuite = Lawsuite::where('base_encode', $base_encode)->with(['client'])->first();
        $qr_code = QrCode::generate(route('admin.show.qr.contract', $lawsuite->base_encode));
        return view('layouts.admin.qr_lawsuite', compact('lawsuite', 'qr_code'));
    }
}
