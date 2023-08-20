<?php
namespace App\Repository;


interface LawsuiteNumberRepositoryInterface {
    // store caseType
    public function store($request);

    // update caseType
    public function update($request, $lawsuites_number);

    // delete caseType
    public function destroy($lawsuites_number);
}