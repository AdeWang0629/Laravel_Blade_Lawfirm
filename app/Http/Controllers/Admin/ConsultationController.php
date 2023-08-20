<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConsultationRequest;
use App\Models\Consultation;
use App\Repository\ConsultationRepositoryInterface;

class ConsultationController extends Controller
{
    public $consultations;
    public function __construct(ConsultationRepositoryInterface $consultations) {
        $this->consultations = $consultations;
        $this->middleware('permission:consultation_list|consultation_show|consultation_create|consultation_edit|consultation_delete', ['only' => ['index']]);
        $this->middleware('permission:consultation_show', ['only' => ['show']]);
        $this->middleware('permission:consultation_showContract', ['only' => ['showContract']]);
        $this->middleware('permission:consultation_create', ['only' => ['create','store']]);
        $this->middleware('permission:consultation_edit', ['only' => ['edit','update', 'judgmentUpdate']]);
        $this->middleware('permission:consultation_delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        return $this->consultations->index();
    }

    public function show(Consultation $consultation)
    {
        return $this->consultations->show($consultation);
    }

    public function create()
    {
        return $this->consultations->create();
    }

    public function store(ConsultationRequest $request)
    {
        return $this->consultations->store($request);
    }

    public function edit(Consultation $consultation)
    {
        return $this->consultations->edit($consultation);
    }

    public function update(ConsultationRequest $request, Consultation $consultation)
    {
        return $this->consultations->update($request, $consultation);
    }

    public function destroy(Consultation $consultation)
    {
        return $this->consultations->delete($consultation);
    }

    public function showContract($id)
    {
        return $this->consultations->showContract($id);
    }

    public function qrContract($base_encode)
    {
        return $this->consultations->qrContract($base_encode);
    }
}
