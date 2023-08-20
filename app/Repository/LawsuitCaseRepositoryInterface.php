<?php
namespace App\Repository;


interface LawsuitCaseRepositoryInterface {
    // all LawsuitCase
    public function index();

    // all trashed LawsuitCase
    public function trashed();

    // store LawsuitCase
    public function store($request);

    // update LawsuitCase
    public function update($request, $id);

    // delete LawsuitCase
    public function delete($id);

    // forceDelete LawsuitCase
    public function forceDelete($id);

    // restore LawsuitCase
    public function restore($id);
}
