<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourtRequest;
use App\Repository\CourtRepositoryInterface;
use Illuminate\Http\Request;

class CourtController extends Controller
{
    public $court;
    public function __construct(CourtRepositoryInterface $court) {
        $this->court = $court;
        $this->middleware('permission:court_list|court_create|court_edit|court_delete|court_restore', ['only' => ['index']]);
        $this->middleware('permission:court_create', ['only' => ['store']]);
        $this->middleware('permission:court_edit', ['only' => ['update']]);
        $this->middleware('permission:court_delete', ['only' => ['forceDelete','destroy']]);
        $this->middleware('permission:court_restore', ['only' => ['restore']]);

    }

    public function index()
    {
        return $this->court->index();
    }

    public function trashed()
    {
        return $this->court->trashed();
    }

    public function store(CourtRequest $request)
    {
        return $this->court->store($request);
    }

    public function update(CourtRequest $request, $id)
    {
        return $this->court->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->court->delete($id);
    }

    public function forceDelete($id)
    {
        return $this->court->forceDelete($id);
    }

    public function restore($id)
    {
        return $this->court->restore($id);
    }
}
