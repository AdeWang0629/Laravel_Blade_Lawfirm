<?php

namespace App\Repository;

use App\Models\Court;
use App\Repository\CourtRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Stevebauman\Purify\Facades\Purify;

class CourtRepository implements CourtRepositoryInterface {

    public function index()
    {
        $courts = Court::withCount('lawsuites')->orderByDesc('id')->get();
        $trashed = Court::onlyTrashed()->get();
        return view('admin.courts.index', compact('courts','trashed'));
    }

    public function trashed()
    {
        $trashed = Court::onlyTrashed()->withCount('lawsuites')->orderByDesc('id')->get();
        return view('admin.courts.trash', compact('trashed'));
    }


    public function store($request)
    {
        try {
            Court::create(['name' => Purify::clean($request->name)]);
            toast(trans('site.created successfully', ['attr' => removebeginninLetters(trans_choice('site.courts', 0), 2)]),'success');
            return back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request, $id)
    {
        try {
            $courts = Court::findOrFail($id);
            $courts->update(['name' => Purify::clean($request->name)]);
            toast(trans('site.updated successfully', ['attr' => trans_choice('site.courts', 0)]),'success');
            return back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function delete($id)
    {
        $court = Court::findOrFail($id);
        if ($court->lawsuites->count() > 0 || $court->caseSessions->count() > 0) {
            toast(trans('site.should_be_deleted_children_first'), 'warning');
            return back();
        }
        $court->delete();
        toast(trans('site.deleted successfully', ['attr' => trans_choice('site.courts', 0)]),'success');
        return back();
    }

    public function forceDelete($id)
    {
        $court = Court::onlyTrashed()->findOrFail($id);

        if ($court->lawsuites->count() > 0 || $court->caseSessions->count() > 0) {
            toast(trans('site.should_be_deleted_children_first'), 'warning');
            return back();
        }

        $court->forceDelete();
        toast(trans('site.deleted successfully', ['attr' => trans_choice('site.courts', 0)]),'success');
        return back();
    }

    public function restore($id)
    {
        $court = Court::onlyTrashed()->findOrFail($id);

        $court->restore();
        toast(trans('site.restored successfully', ['attr' => trans_choice('site.courts', 0)]),'success');
        return back();
    }
}
