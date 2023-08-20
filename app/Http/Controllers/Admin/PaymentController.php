<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Models\Payment;
use App\Repository\PaymentRepositoryInterface;

class PaymentController extends Controller
{
    public $payments;
    public function __construct(PaymentRepositoryInterface $payments) {
        $this->payments = $payments;
        $this->middleware('permission:payment_list|payment_create|payment_edit|payment_delete|payment_showReceipt', ['only' => ['index']]);
        $this->middleware('permission:payment_create', ['only' => ['store']]);
        $this->middleware('permission:payment_edit', ['only' => ['update']]);
        $this->middleware('permission:payment_delete', ['only' => ['destroy']]);
        $this->middleware('permission:payment_showReceipt', ['only' => ['showReceipt']]);
    }

    public function index()
    {
        return $this->payments->index();
    }

    public function store(PaymentRequest $request)
    {
        return $this->payments->store($request);
    }

    public function update(PaymentRequest $request, Payment $payment)
    {
        return $this->payments->update($request, $payment);
    }

    public function destroy(Payment $payment)
    {
        return $this->payments->delete($payment);
    }

    public function showReceipt($id)
    {
        return $this->payments->showReceipt($id);
    }

    public function qrReceipt($base_encode)
    {
        return $this->payments->qrReceipt($base_encode);
    }
}
