<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BranchRequest;
use App\Models\Branch;
use App\Repository\BranchRepositoryInterface;

class BranchController extends Controller
{
    public $branches;
    public function __construct(BranchRepositoryInterface $branches) {
        $this->branches = $branches;
        $this->middleware('permission:branche_list|branche_create|branche_edit|branche_delete|branche_restore', ['only' => ['index']]);
        $this->middleware('permission:branche_create', ['only' => ['store']]);
        $this->middleware('permission:branche_edit', ['only' => ['update']]);
        $this->middleware('permission:branche_delete', ['only' => ['forceDelete','destroy']]);
        $this->middleware('permission:branche_restore', ['only' => ['restore']]);
    }

    public function index()
    {
        return $this->branches->index();
    }

    public function trashed()
    {
        return $this->branches->trashed();
    }

    public function store(BranchRequest $request)
    {
        return $this->branches->store($request);
    }

    public function update(BranchRequest $request,Branch $branch)
    {
        return $this->branches->update($request, $branch);
    }

    public function destroy(Branch $branch)
    {
        return $this->branches->delete($branch);
    }

    public function forceDelete($id)
    {
        return $this->branches->forceDelete($id);
    }

    public function restore($id)
    {
        return $this->branches->restore($id);
    }
}
