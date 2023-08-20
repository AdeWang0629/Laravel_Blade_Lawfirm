<?php

namespace App\Repository;

use App\Models\Branch;
use App\Repository\BranchRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Stevebauman\Purify\Facades\Purify;

class BranchRepository implements BranchRepositoryInterface {

    public function index()
    {
        $branches = Branch::with('payments')->orderByDesc('id')->get();
        $trashed = Branch::onlyTrashed()->get();
        return view('admin.branches.index', compact('branches', 'trashed'));
    }

    public function trashed()
    {
        $trashed = Branch::onlyTrashed()->with('payments')->orderByDesc('id')->get();
        return view('admin.branches.trash', compact('trashed'));
    }

    public function store($request)
    {
        try {
            Branch::create(['name' => Purify::clean($request->name)]);
            toast(trans('site.created successfully', ['attr' => trans_choice('site.branches', 0)]),'success');
            return back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request, $branch)
    {
        try {
            $branch->update(['name' => Purify::clean($request->name)]);
            toast(trans('site.updated successfully', ['attr' => trans_choice('site.branches', 0)]),'success');
            return back();
        } catch (\Exception $e) {
            return redirect()->back()->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function delete($branch)
    {
        if ($branch->payments->count() > 0) {
            toast(trans('site.should_be_deleted_children_first'), 'warning');
            return back();
        }

        $branch->delete();
        toast(trans('site.deleted successfully', ['attr' => trans_choice('site.branches', 0)]),'error');
        return back();
    }

    public function forceDelete($id)
    {
        $branch = Branch::onlyTrashed()->findOrFail($id);
        if ($branch->payments->count() > 0) {
            toast(trans('site.should_be_deleted_children_first'), 'warning');
            return back();
        }

        $branch->forceDelete();
        toast(trans('site.deleted successfully', ['attr' => trans_choice('site.branches', 0)]),'error');
        return back();
    }

    public function restore($id)
    {
        $branch = Branch::onlyTrashed()->findOrFail($id);

        $branch->restore();
        toast(trans('site.restored successfully', ['attr' => trans_choice('site.branches', 0)]),'success');
        return back();
    }
}
