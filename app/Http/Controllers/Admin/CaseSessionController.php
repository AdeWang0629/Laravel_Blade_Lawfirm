<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CaseSessionRequest;
use App\Models\CaseSession;
use App\Repository\CaseSessionRepositoryInterface;
use Illuminate\Http\Request;

class CaseSessionController extends Controller
{
    public $caseSession;
    public function __construct(CaseSessionRepositoryInterface $caseSession) {
        $this->caseSession = $caseSession;
        $this->middleware('permission:caseSession_show', ['only' => ['index', 'show']]);
        $this->middleware('permission:caseSession_create', ['only' => ['store']]);
        $this->middleware('permission:caseSession_edit', ['only' => ['edit','update']]);
        $this->middleware('permission:caseSession_delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        return $this->caseSession->index();
    }

    public function store(CaseSessionRequest $request)
    {
        return $this->caseSession->store($request);
    }
    
    public function show(CaseSession $caseSession)
    {
        return $this->caseSession->show($caseSession);
    }

    public function edit(CaseSession $caseSession)
    {
        return $this->caseSession->edit($caseSession);
    }

    public function update(CaseSessionRequest $request, CaseSession $caseSession)
    {
        return $this->caseSession->update($request, $caseSession);
    }

    public function destroy(CaseSession $caseSession)
    {
        return $this->caseSession->destroy($caseSession);
    }
}
