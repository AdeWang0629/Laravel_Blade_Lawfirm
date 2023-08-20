<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Repository\ClientRepositoryInterface;

class ClientController extends Controller
{
    public $client;
    public function __construct(ClientRepositoryInterface $client) {
        $this->client = $client;
        $this->middleware('permission:client_list|client_create|client_show|client_edit|client_delete|client_restore', ['only' => ['index']]);
        $this->middleware('permission:client_create', ['only' => ['store']]);
        $this->middleware('permission:client_show', ['only' => ['show']]);
        $this->middleware('permission:client_edit', ['only' => ['update']]);
        $this->middleware('permission:client_delete', ['only' => ['forceDelete','destroy']]);
        $this->middleware('permission:client_restore', ['only' => ['restore']]);
    }

    public function index()
    {
        return $this->client->index();
    }

    public function trashed()
    {
        return $this->client->trashed();
    }

    public function store(ClientRequest $request)
    {
        return $this->client->store($request);
    }

    public function show(Client $client)
    {
        return $this->client->show($client);
    }

    public function update(ClientRequest $request, Client $client)
    {
        return $this->client->update($request, $client);
    }

    public function destroy(Client $client)
    {
        return $this->client->delete($client);
    }

    public function forceDelete($id)
    {
        return $this->client->forceDelete($id);
    }

    public function restore($id)
    {
        return $this->client->restore($id);
    }
}
