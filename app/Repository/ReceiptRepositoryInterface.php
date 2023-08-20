<?php
namespace App\Repository;


interface ReceiptRepositoryInterface {
    // all Receipt
    public function index();

    // store Receipt
    public function store($request);

    // update Receipt
    public function update($request, $receipt);

    // delete Receipt
    public function delete($receipt);

    // showReceipt
    public function showReceipt($id);

    // qrReceipt
    public function qrReceipt($base_encode);
}