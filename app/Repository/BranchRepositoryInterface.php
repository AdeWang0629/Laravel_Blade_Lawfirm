<?php
namespace App\Repository;


interface BranchRepositoryInterface {
    // all branches
    public function index();

    // all trashed branches
    public function trashed();

    // store branch
    public function store($request);

    // update branch
    public function update($request, $branch);

    // delete branch
    public function delete($branch);

    // forceDelete branch
    public function forceDelete($id);

    // restore branch
    public function restore($id);
}
