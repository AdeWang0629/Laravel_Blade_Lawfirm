<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LawsuitePaperRequest;
use App\Models\LawsuitePaper;
use App\Repository\LawsuitePaperRepositoryInterface;
use Illuminate\Http\Request;

class LawsuitePaperController extends Controller
{
    public $lawsuitePapers;
    public function __construct(LawsuitePaperRepositoryInterface $lawsuitePapers) {
        $this->lawsuitePapers = $lawsuitePapers;
        $this->middleware('permission:lawsuitePaper_list|lawsuitePaper_show|lawsuitePaper_create|lawsuitePaper_edit|lawsuitePaper_delete', ['only' => ['index']]);
        $this->middleware('permission:lawsuitePaper_show', ['only' => ['show']]);
        $this->middleware('permission:lawsuitePaper_create', ['only' => ['store']]);
        $this->middleware('permission:lawsuitePaper_edit', ['only' => ['update']]);
        $this->middleware('permission:lawsuitePaper_delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        return $this->lawsuitePapers->index();
    }

    public function show(LawsuitePaper $lawsuites_paper)
    {
        return $this->lawsuitePapers->show($lawsuites_paper);
    }

    public function store(LawsuitePaperRequest $request)
    {
        return $this->lawsuitePapers->store($request);
    }

    public function update(LawsuitePaperRequest $request, LawsuitePaper $lawsuites_paper)
    {
        return $this->lawsuitePapers->update($request, $lawsuites_paper);
    }

    public function destroy(LawsuitePaper $lawsuites_paper)
    {
        return $this->lawsuitePapers->destroy($lawsuites_paper);
    }
}
