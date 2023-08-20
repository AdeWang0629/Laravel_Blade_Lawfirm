<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\lawsuitCaseRequest;
use App\Repository\LawsuitCaseRepositoryInterface;

class LawsuitCaseController extends Controller
{
    public $lawsuitCase;
    public function __construct(LawsuitCaseRepositoryInterface $lawsuitCase) {
        $this->lawsuitCase = $lawsuitCase;
        $this->middleware('permission:lawsuitCase_list|lawsuitCase_create|lawsuitCase_edit|lawsuitCase_delete|lawsuitCase_restore', ['only' => ['index']]);
        $this->middleware('permission:lawsuitCase_create', ['only' => ['store']]);
        $this->middleware('permission:lawsuitCase_edit', ['only' => ['update']]);
        $this->middleware('permission:lawsuitCase_delete', ['only' => ['forceDelete','destroy']]);
        $this->middleware('permission:lawsuitCase_restore', ['only' => ['restore']]);
    }

    public function index()
    {
        return $this->lawsuitCase->index();
    }

    public function trashed()
    {
        return $this->lawsuitCase->trashed();
    }

    public function store(lawsuitCaseRequest $request)
    {
        return $this->lawsuitCase->store($request);
    }

    public function update(lawsuitCaseRequest $request, $id)
    {
        return $this->lawsuitCase->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->lawsuitCase->delete($id);
    }

    public function forceDelete($id)
    {
        return $this->lawsuitCase->forceDelete($id);
    }

    public function restore($id)
    {
        return $this->lawsuitCase->restore($id);
    }
}
