<?php

namespace App\Repository;

use App\Models\Branch;
use App\Models\ClientAccount;
use App\Models\ExpenseSection;
use App\Models\FundAccount;
use App\Models\Payment;
use App\Repository\PaymentRepositoryInterface;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Stevebauman\Purify\Facades\Purify;

class PaymentRepository implements PaymentRepositoryInterface {
    public function index()
    {
        $payments = Payment::with('branch', 'expenseSection')->get();
        $expenseSections = ExpenseSection::get();
        $branches = Branch::get();
        return view('admin.payments.index', compact('payments','expenseSections', 'branches'));
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $payment = Payment::create([
                'receiver'              => $request->receiver,
                'voucher_number'        => voucherNumber(),
                'base_encode'           => base64_encode(lawsuiteCaseNumber().\Illuminate\Support\Str::random(40)),
                'date'                  => Purify::clean($request->date),
                'payment_type'          => Purify::clean($request->payment_type),
                'expense_section_id'    => Purify::clean($request->expense_section_id),
                'branch_id'             => $request->branch_id,
                'debit'                 => Purify::clean($request->debit),
                'note'                  => Purify::clean($request->note),
            ]);

            FundAccount::create([
                'date'                  => Purify::clean($request->date),
                'payment_id'            => $payment->id,
                'debit'                 => 0.00,
                'credit'                => Purify::clean($request->debit),
                'note'                  => Purify::clean($request->note),
            ]);

            DB::commit();
            toast(trans('site.created successfully', ['attr' => trans_choice('site.expenses', 0)]),'success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request, $payment)
    {
        DB::beginTransaction();
        try {
            $payment->update([
                'receiver'              => Purify::clean($request->receiver),
                'date'                  => Purify::clean($request->date),
                'payment_type'          => Purify::clean($request->payment_type),
                'expense_section_id'    => $request->expense_section_id,
                'branch_id'             => $request->branch_id,
                'debit'                 => Purify::clean($request->debit),
                'note'                  => Purify::clean($request->note),
            ]);

            FundAccount::where('payment_id', $payment->id)->update([
                'date'                  => Purify::clean($request->date),
                'payment_id'            => $payment->id,
                'credit'                => Purify::clean($request->debit),
                'note'                  => Purify::clean($request->note),
            ]);

            DB::commit();
            toast(trans('site.updated successfully', ['attr' => trans_choice('site.expenses', 0)]),'success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function delete($payment)
    {
        $payment->delete();
        toast(trans('site.deleted successfully', ['attr' => trans_choice('site.expenses', 0)]),'error');
        return redirect()->back();
    }

    public function showReceipt($id)
    {
        $payment = Payment::where('id', $id)->with(['branch', 'expenseSection'])->first();
        $qr_code = QrCode::generate(route('admin.show.qr.payment.receipt', $payment->base_encode));
        return view('layouts.admin.payment_voucher', compact('payment', 'qr_code'));
    }

    public function qrReceipt($base_encode)
    {
        $payment = Payment::where('base_encode', $base_encode)->with(['branch', 'expenseSection'])->first();
        $qr_code = QrCode::generate(route('admin.show.qr.payment.receipt', $payment->base_encode));
        return view('layouts.admin.qr_payment_voucher', compact('payment', 'qr_code'));
    }
}
