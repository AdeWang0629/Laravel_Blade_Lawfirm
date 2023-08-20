<?php
namespace App\Repository;


interface CaseSessionRepositoryInterface {
    // all CaseSession
    public function index();

    // store CaseSession
    public function store($request);

    // show CaseSession
    public function show($caseSession);

    // edit CaseSession
    public function edit($caseSession);

    // update CaseSession
    public function update($request, $caseSession);

    // destroy CaseSession
    public function destroy($caseSession);
}