<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientTypeRequest;
use App\Repository\ClientTypeRepositoryInterface;

class ClientTypeController extends Controller
{
    public $clientType;
    public function __construct(ClientTypeRepositoryInterface $clientType) {
        $this->clientType = $clientType;
        $this->middleware('permission:clientType_list|clientType_create|clientType_edit|clientType_delete|clientType_restore', ['only' => ['index']]);
        $this->middleware('permission:clientType_create', ['only' => ['store']]);
        $this->middleware('permission:clientType_edit', ['only' => ['update']]);
        $this->middleware('permission:clientType_delete', ['only' => ['forceDelete','destroy']]);
        $this->middleware('permission:clientType_restore', ['only' => ['restore']]);
    }

    public function index()
    {
        return $this->clientType->index();
    }

    public function trashed()
    {
        return $this->clientType->trashed();
    }

    public function store(ClientTypeRequest $request)
    {
        return $this->clientType->store($request);
    }

    public function update(ClientTypeRequest $request, $id)
    {
        return $this->clientType->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->clientType->delete($id);
    }

    public function forceDelete($id)
    {
        return $this->clientType->forceDelete($id);
    }

    public function restore($id)
    {
        return $this->clientType->restore($id);
    }
}
