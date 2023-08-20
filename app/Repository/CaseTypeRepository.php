<?php

namespace App\Repository;

use App\Models\CaseType;
use App\Repository\CaseTypeRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Stevebauman\Purify\Facades\Purify;

class CaseTypeRepository implements CaseTypeRepositoryInterface {

    public function index()
    {
        $caseTypes = CaseType::withCount('lawsuites')->orderByDesc('id')->get();
        $trashed = CaseType::onlyTrashed()->get();
        return view('admin.cases-types.index', compact('caseTypes', 'trashed'));
    }

    public function trashed()
    {
        $trashed = CaseType::onlyTrashed()->withCount('lawsuites')->orderByDesc('id')->get();
        return view('admin.cases-types.trash', compact('trashed'));
    }

    public function store($request)
    {
        try {
            CaseType::create(['name' => Purify::clean($request->name)]);
            toast(trans('site.created successfully', ['attr' => removebeginninLetters(trans_choice('site.categories', 0), 2) .' '. trans_choice('site.lawsuites', 0)]),'success');
            return back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request, $id)
    {
        try {
            $caseType = CaseType::findOrFail($id);
            $caseType->update(['name' => Purify::clean($request->name)]);
            toast(trans('site.updated successfully', ['attr' => removebeginninLetters(trans_choice('site.categories', 0), 2) .' '. trans_choice('site.lawsuites', 0)]),'success');
            return back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function delete($id)
    {
        $caseType = CaseType::findOrFail($id);

        if ($caseType->lawsuites->count() > 0) {
            toast(trans('site.should_be_deleted_children_first'), 'warning');
            return back();
        }

        $caseType->delete();
        toast(trans('site.deleted successfully', ['attr' => removebeginninLetters(trans_choice('site.categories', 0), 2) .' '. trans_choice('site.lawsuites', 0)]),'success');
        return back();
    }

    public function forceDelete($id)
    {
        $caseType = CaseType::onlyTrashed()->findOrFail($id);
        if ($caseType->lawsuites->count() > 0) {
            toast(trans('site.should_be_deleted_children_first'), 'warning');
            return back();
        }

        $caseType->forceDelete();
        toast(trans('site.deleted successfully', ['attr' => removebeginninLetters(trans_choice('site.categories', 0), 2) .' '. trans_choice('site.lawsuites', 0)]),'success');
        return back();
    }

    public function restore($id)
    {
        $caseType = CaseType::onlyTrashed()->findOrFail($id);

        $caseType->restore();
        toast(trans('site.restored successfully', ['attr' => removebeginninLetters(trans_choice('site.categories', 0), 2) .' '. trans_choice('site.lawsuites', 0)]),'success');
        return back();
    }
}
