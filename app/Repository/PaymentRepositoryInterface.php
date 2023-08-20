<?php
namespace App\Repository;


interface PaymentRepositoryInterface {
    // all Payments
    public function index();

    // store Payment
    public function store($request);

    // update Payment
    public function update($request, $payment);

    // delete Payment
    public function delete($payment);
    
    // showReceipt
    public function showReceipt($id);

    // qrReceipt
    public function qrReceipt($base_encode);
}