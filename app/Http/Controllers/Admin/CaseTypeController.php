<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CaseTypeRequest;
use App\Repository\CaseTypeRepositoryInterface;
use Illuminate\Http\Request;

class CaseTypeController extends Controller
{
    public $caseType;
    public function __construct(CaseTypeRepositoryInterface $caseType) {
        $this->caseType = $caseType;
        $this->middleware('permission:caseType_list|caseType_create|caseType_edit|caseType_delete|caseType_restore', ['only' => ['trashed', 'index']]);
        $this->middleware('permission:caseType_create', ['only' => ['store']]);
        $this->middleware('permission:caseType_edit', ['only' => ['update']]);
        $this->middleware('permission:caseType_delete', ['only' => ['forceDelete','destroy']]);
        $this->middleware('permission:caseType_restore', ['only' => ['restore']]);
    }

    public function index()
    {
        return $this->caseType->index();
    }

    public function trashed()
    {
        return $this->caseType->trashed();
    }

    public function store(CaseTypeRequest $request)
    {
        return $this->caseType->store($request);
    }

    public function update(CaseTypeRequest $request, $id)
    {
        return $this->caseType->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->caseType->delete($id);
    }

    public function forceDelete($id)
    {
        return $this->caseType->forceDelete($id);
    }

    public function restore($id)
    {
        return $this->caseType->restore($id);
    }
}
