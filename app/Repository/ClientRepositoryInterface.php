<?php
namespace App\Repository;


interface ClientRepositoryInterface {
    // all clients
    public function index();

    // all trashed clients
    public function trashed();

    // store client
    public function store($request);

    // show client
    public function show($client);

    // update client
    public function update($request, $client);

    // delete client
    public function delete($client);

    // forceDelete clients
    public function forceDelete($id);

// restore clients
    public function restore($id);
}
