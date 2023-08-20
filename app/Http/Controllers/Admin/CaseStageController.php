<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CaseStageRequest;
use App\Repository\CaseStageRepositoryInterface;

class CaseStageController extends Controller
{
    public $caseStage;
    public function __construct(CaseStageRepositoryInterface $caseStage) {
        $this->caseStage = $caseStage;
        $this->middleware('permission:caseStage_list|caseStage_create|caseStage_edit|caseStage_delete|caseStage_restore', ['only' => ['index']]);
        $this->middleware('permission:caseStage_create', ['only' => ['store']]);
        $this->middleware('permission:caseStage_edit', ['only' => ['update']]);
        $this->middleware('permission:caseStage_delete', ['only' => ['forceDelete','destroy']]);
        $this->middleware('permission:caseStage_restore', ['only' => ['restore']]);
    }

    public function index()
    {
        return $this->caseStage->index();
    }

    public function trashed()
    {
        return $this->caseStage->trashed();
    }

    public function store(CaseStageRequest $request)
    {
        return $this->caseStage->store($request);
    }

    public function update(CaseStageRequest $request, $id)
    {
        return $this->caseStage->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->caseStage->delete($id);
    }

    public function forceDelete($id)
    {
        return $this->caseStage->forceDelete($id);
    }

    public function restore($id)
    {
        return $this->caseStage->restore($id);
    }
}
