<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReceiptRequest;
use App\Models\Receipt;
use App\Repository\ReceiptRepositoryInterface;

class ReceiptController extends Controller
{
    public $receipt;
    public function __construct(ReceiptRepositoryInterface $receipt) {
        $this->receipt = $receipt;
        $this->middleware('permission:receipt_list|receipt_create|receipt_edit|receipt_delete|receipt_showReceipt', ['only' => ['index']]);
        $this->middleware('permission:receipt_create', ['only' => ['store']]);
        $this->middleware('permission:receipt_edit', ['only' => ['update']]);
        $this->middleware('permission:receipt_delete', ['only' => ['destroy']]);
        $this->middleware('permission:receipt_showReceipt', ['only' => ['showReceipt']]);
    }

    public function index()
    {
        return $this->receipt->index();
    }

    public function store(ReceiptRequest $request)
    {
        return $this->receipt->store($request);
    }

    public function update(ReceiptRequest $request, Receipt $receipt)
    {
        return $this->receipt->update($request, $receipt);
    }

    public function destroy(Receipt $receipt)
    {
        return $this->receipt->delete($receipt);
    }

    public function showReceipt($id)
    {
        return $this->receipt->showReceipt($id);
    }

    public function qrReceipt($base_encode)
    {
        return $this->receipt->qrReceipt($base_encode);
    }
}
