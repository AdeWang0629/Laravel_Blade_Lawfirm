<?php
namespace App\Repository;


interface ClientTypeRepositoryInterface {
    // all clients types
    public function index();

    // all trashed clients types
    public function trashed();

    // store clientType
    public function store($request);

    // update clientType
    public function update($request, $id);

    // delete clientType
    public function delete($id);

    // forceDelete clientType
    public function forceDelete($id);

    // restore clientType
    public function restore($id);

}
