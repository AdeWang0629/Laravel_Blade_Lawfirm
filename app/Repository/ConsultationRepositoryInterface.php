<?php
namespace App\Repository;


interface ConsultationRepositoryInterface {
    // all Consultations
    public function index();

    // show Consultation
    public function show($lawsuite);

    // create Consultation
    public function create();

    // store Consultation
    public function store($request);

    // update Consultation
    public function edit($lawsuite);

    // update Consultation
    public function update($request, $lawsuite);

    // delete Consultation
    public function delete($lawsuite);

    // lawsuite showContract
    public function showContract($id);

    // lawsuite qrContract
    public function qrContract($base_encode);
}