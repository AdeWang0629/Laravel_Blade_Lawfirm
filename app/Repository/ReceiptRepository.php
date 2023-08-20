<?php

namespace App\Repository;

use App\Models\ClientAccount;
use App\Models\FundAccount;
use App\Models\Receipt;
use App\Repository\ReceiptRepositoryInterface;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Stevebauman\Purify\Facades\Purify;

class ReceiptRepository implements ReceiptRepositoryInterface {
    public function index()
    {
        $receipts = Receipt::when(request()->type, function ($q)
        {
            if (request()->type == 'lawsuites') {
                return $q->whereNotNull('lawsuite_id');
            }elseif (request()->type == 'consultations') {
                return $q->whereNotNull('consultation_id');
            }
        })->get();
        return view('admin.receipts.index', compact('receipts'));
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $receipt = Receipt::create([
                'title'                 => Purify::clean($request->title),
                'receipt_number'        => receiptNumber(),
                'base_encode'           => base64_encode(receiptNumber().\Illuminate\Support\Str::random(40)),
                'date'                  => Purify::clean($request->date),
                'payment_type'          => Purify::clean($request->payment_type),
                'client_id'             => $request->client_id,
                'lawsuite_id'           => $request->lawsuite_id,
                'consultation_id'       => $request->consultation_id,
                'debit'                 => Purify::clean($request->debit),
                'note'                  => Purify::clean($request->note),
            ]);

            FundAccount::create([
                'date'                  => Purify::clean($request->date),
                'receipt_id'            => $receipt->id,
                'credit'                => 0.00,
                'debit'                 => Purify::clean($request->debit),
                'note'                  => Purify::clean($request->note),
            ]);

            ClientAccount::create([
                'type'                  => 'receipt_payment',
                'client_id'             => $request->client_id,
                'lawsuite_id'           => $request->lawsuite_id,
                'consultation_id'       => $request->consultation_id,
                'receipt_id'            => Purify::clean($receipt->id),
                'credit'                => Purify::clean($request->debit),
                'debit'                 => 0.00,
            ]);

            DB::commit();
            toast(trans('site.created successfully', ['attr' => trans('site.receipt')]),'success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request, $receipt)
    {
        DB::beginTransaction();
        try {
            $receipt->update([
                'title'             => Purify::clean($request->title),
                'date'              => Purify::clean($request->date),
                'payment_type'      => Purify::clean($request->payment_type),
                'client_id'         => $request->client_id,
                'lawsuite_id'       => $request->lawsuite_id,
                'consultation_id'   => $request->consultation_id,
                'debit'             => Purify::clean($request->debit),
                'note'              => Purify::clean($request->note),
            ]);

            FundAccount::where('receipt_id', $receipt->id)->update([
                'date'                  => Purify::clean($request->date),
                'credit'                => 0.00,
                'debit'                 => Purify::clean($request->debit),
                'note'                  => Purify::clean($request->note),
            ]);


            $receipt->clientAccount->where('receipt_id', $receipt->id)->where('client_id', $receipt->client_id)->update([
                'credit'         => Purify::clean($request->debit)
            ]);

            DB::commit();
            toast(trans('site.updated successfully', ['attr' => trans('site.receipt')]),'success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function delete($receipt)
    {
        $receipt->delete();
        toast(trans('site.deleted successfully', ['attr' => trans('site.receipt')]),'success');
        return redirect()->back();
    }

    public function showReceipt($id)
    {
        $receipt = Receipt::where('id', $id)->with('client','clientAccount','lawsuite','consultation')->first();
        $qr_code = QrCode::generate(route('admin.show.qr.receipt', $receipt->base_encode));
        return view('layouts.admin.receipt', compact('receipt', 'qr_code'));
    }

    public function qrReceipt($base_encode)
    {
        $receipt = Receipt::where('base_encode', $base_encode)->with('client','clientAccount','lawsuite','consultation')->first();
        $qr_code = QrCode::generate(route('admin.show.qr.receipt', $receipt->base_encode));
        return view('layouts.admin.qr_receipt', compact('receipt', 'qr_code'));
    }
}
