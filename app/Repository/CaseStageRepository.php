<?php

namespace App\Repository;

use App\Models\CaseStage;
use App\Repository\CaseStageRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Stevebauman\Purify\Facades\Purify;

class CaseStageRepository implements CaseStageRepositoryInterface {

    public function index()
    {
        $caseStages = CaseStage::withCount('lawsuites')->orderByDesc('id')->get();
        $trashed = CaseStage::onlyTrashed()->get();
        return view('admin.case-stages.index', compact('caseStages','trashed'));
    }

    public function trashed()
    {
        $trashed = CaseStage::onlyTrashed()->withCount('lawsuites')->orderByDesc('id')->get();
        return view('admin.case-stages.trash', compact('trashed'));
    }

    public function store($request)
    {
        try {
            CaseStage::create(['name' => Purify::clean($request->name)]);
            toast(trans('site.created successfully', ['attr' => removebeginninLetters(trans_choice('site.stages', 0), 2) .' '. removebeginninLetters(trans('site.litigation'), 2)]),'success');
            return back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request, $id)
    {
        try {
            $caseStage = CaseStage::findOrFail($id);
            $caseStage->update(['name' => Purify::clean($request->name)]);
            toast(trans('site.updated successfully', ['attr' => removebeginninLetters(trans_choice('site.stages', 0), 2) .' '. trans('site.litigation')]),'success');
            return back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function delete($id)
    {
        $caseStage = CaseStage::findOrFail($id);

        if ($caseStage->lawsuites->count() > 0) {
            toast(trans('site.should_be_deleted_children_first'), 'warning');
            return back();
        }

        $caseStage->delete();
        toast(trans('site.deleted successfully', ['attr' => removebeginninLetters(trans_choice('site.stages', 0), 2) .' '. trans('site.litigation')]),'success');
        return back();
    }

    public function forceDelete($id)
    {
        $caseStages = CaseStage::onlyTrashed()->findOrFail($id);
        if ($caseStages->lawsuites->count() > 0) {
            toast(trans('site.should_be_deleted_children_first'), 'warning');
            return back();
        }

        $caseStages->forceDelete();
        toast(trans('site.deleted successfully', ['attr' => removebeginninLetters(trans_choice('site.stages', 0), 2) .' '. trans('site.litigation')]),'success');
        return back();
    }

    public function restore($id)
    {
        $caseStages = CaseStage::onlyTrashed()->findOrFail($id);

        $caseStages->restore();
        toast(trans('site.restored successfully', ['attr' => removebeginninLetters(trans_choice('site.stages', 0), 2) .' '. trans('site.litigation')]),'success');
        return back();
    }
}
