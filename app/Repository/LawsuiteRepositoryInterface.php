<?php
namespace App\Repository;


interface LawsuiteRepositoryInterface {
    // all cases types
    public function index();

    // show caseType
    public function show($lawsuite);

    // create caseType
    public function create();

    // store caseType
    public function store($request);

    // update caseType
    public function edit($lawsuite);

    // update caseType
    public function update($request, $lawsuite);

    // delete caseType
    public function delete($lawsuite);

    // lawsuitesStatus
    public function lawsuitesStatus($id);

    // lawsuite showContract
    public function judgmentUpdate($request, $lawsuite);
    
    // lawsuite showContract
    public function showContract($id);

    // lawsuite qrContract
    public function qrContract($base_encode);
}