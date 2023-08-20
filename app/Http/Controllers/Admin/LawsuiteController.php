<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LawsuiteRequest;
use App\Models\Lawsuite;
use App\Repository\LawsuiteRepositoryInterface;
use Illuminate\Http\Request;

class LawsuiteController extends Controller
{
    public $lawsuite;
    public function __construct(LawsuiteRepositoryInterface $lawsuite) {
        $this->lawsuite = $lawsuite;
        $this->middleware('permission:lawsuite_list|lawsuite_show|lawsuite_showContract|lawsuite_create|lawsuite_edit|lawsuite_delete|lawsuite_judgmentUpdate', ['only' => ['index', 'lawsuitesStatus']]);
        $this->middleware('permission:lawsuite_show', ['only' => ['show']]);
        $this->middleware('permission:lawsuite_showContract', ['only' => ['showContract']]);
        $this->middleware('permission:lawsuite_create', ['only' => ['create','store']]);
        $this->middleware('permission:lawsuite_edit', ['only' => ['edit','update']]);
        $this->middleware('permission:lawsuite_delete', ['only' => ['destroy']]);
        $this->middleware('permission:lawsuite_judgmentUpdate', ['only' => ['judgmentUpdate']]);
    }

    public function index()
    {
        return $this->lawsuite->index();
    }

    public function show(Lawsuite $lawsuite)
    {
        return $this->lawsuite->show($lawsuite);
    }

    public function create()
    {
        return $this->lawsuite->create();
    }

    public function store(LawsuiteRequest $request)
    {
        return $this->lawsuite->store($request);
    }

    public function edit(Lawsuite $lawsuite)
    {
        return $this->lawsuite->edit($lawsuite);
    }

    public function update(LawsuiteRequest $request, Lawsuite $lawsuite)
    {
        return $this->lawsuite->update($request, $lawsuite);
    }

    public function destroy(Lawsuite $lawsuite)
    {
        return $this->lawsuite->delete($lawsuite);
    }

    public function lawsuitesStatus($id)
    {
        return $this->lawsuite->lawsuitesStatus($id);
    }
    public function judgmentUpdate(Request $request, Lawsuite $lawsuite)
    {
        return $this->lawsuite->judgmentUpdate($request, $lawsuite);
    }

    public function showContract($id)
    {
        return $this->lawsuite->showContract($id);
    }

    public function qrContract($base_encode)
    {
        return $this->lawsuite->qrContract($base_encode);
    }

}
