<?php
namespace App\Repository;


interface CaseStageRepositoryInterface {
    // all cases types
    public function index();

    // all trashed cases types
    public function trashed();

    // store caseType
    public function store($request);

    // update caseType
    public function update($request, $id);

    // delete caseType
    public function delete($id);

    // forceDelete caseType
    public function forceDelete($id);

    // restore caseType
    public function restore($id);

}
