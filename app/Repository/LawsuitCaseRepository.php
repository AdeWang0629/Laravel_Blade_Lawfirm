<?php

namespace App\Repository;

use App\Models\LawsuitCase;
use App\Repository\LawsuitCaseRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Stevebauman\Purify\Facades\Purify;

class LawsuitCaseRepository implements LawsuitCaseRepositoryInterface {

    public function index()
    {
        $lawsuitCases = LawsuitCase::withCount('lawsuites')->orderByDesc('id')->get();
        $trashed = LawsuitCase::onlyTrashed()->get();
        return view('admin.lawsuits-cases.index', compact('lawsuitCases', 'trashed'));
    }

    public function trashed()
    {
        $trashed = LawsuitCase::onlyTrashed()->withCount('lawsuites')->orderByDesc('id')->get();
        return view('admin.lawsuits-cases.trash', compact('trashed'));
    }

    public function store($request)
    {
        try {
            LawsuitCase::create([
                'name' => Purify::clean($request->name),
                'color' => Purify::clean($request->color),
            ]);
            toast(trans('site.created successfully', ['attr' => trans_choice('site.status', 0) .' '. trans_choice('site.lawsuites', 0)]),'success');
            return back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request, $id)
    {
        try {
            $lawsuitCase = LawsuitCase::findOrFail($id);
            $lawsuitCase->update([
                'name' => Purify::clean($request->name),
                'color' => Purify::clean($request->color),
            ]);
            toast(trans('site.updated successfully', ['attr' => trans_choice('site.status', 0) .' '. trans_choice('site.lawsuites', 0)]),'success');
            return back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function delete($id)
    {
        $lawsuitCase = LawsuitCase::findOrFail($id);
        if ($lawsuitCase->lawsuites->count() > 0) {
            toast(trans('site.should_be_deleted_children_first'), 'warning');
            return back();
        }
        $lawsuitCase->delete();
        toast(trans('site.deleted successfully', ['attr' => trans_choice('site.status', 0) .' '. trans_choice('site.lawsuites', 0)]),'success');
        return back();
    }

    public function forceDelete($id)
    {
        $lawsuitCase = LawsuitCase::onlyTrashed()->findOrFail($id);

        if ($lawsuitCase->lawsuites->count() > 0) {
            toast(trans('site.should_be_deleted_children_first'), 'warning');
            return back();
        }

        $lawsuitCase->forceDelete();
        toast(trans('site.deleted successfully', ['attr' => trans_choice('site.status', 0) .' '. trans_choice('site.lawsuites', 0)]),'success');
        return back();
    }

    public function restore($id)
    {
        $lawsuitCase = LawsuitCase::onlyTrashed()->findOrFail($id);

        $lawsuitCase->restore();
        toast(trans('site.restored successfully', ['attr' => trans_choice('site.status', 0) .' '. trans_choice('site.lawsuites', 0)]),'success');
        return back();
    }
}
