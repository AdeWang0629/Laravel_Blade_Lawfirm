<?php

namespace App\Repository;

use App\Models\Branch;
use App\Models\ExpenseSection;
use App\Repository\ExpenseSectionRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Stevebauman\Purify\Facades\Purify;

class ExpenseSectionRepository implements ExpenseSectionRepositoryInterface {

    public function index()
    {
        $expense_sections = ExpenseSection::with('payments')->orderByDesc('id')->get();
        $trashed = ExpenseSection::onlyTrashed()->get();
        return view('admin.expense-sections.index', compact('expense_sections', 'trashed'));
    }

    public function trashed()
    {
        $trashed = ExpenseSection::onlyTrashed()->with('payments')->orderByDesc('id')->get();
        return view('admin.expense-sections.trash', compact('trashed'));
    }

    public function store($request)
    {
        try {
            ExpenseSection::create(['name' => Purify::clean($request->name)]);
            toast(trans('site.created successfully', ['attr' => removebeginninLetters(trans_choice('site.sections', 0), 2) ]),'success');
            return back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request, $expense_section)
    {
        try {
            $expense_section->update(['name' => Purify::clean($request->name)]);
            toast(trans('site.updated successfully', ['attr' => trans_choice('site.sections', 0) ]),'success');
            return back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function delete($expense_section)
    {
        if ($expense_section->payments->count() > 0) {
            toast(trans('site.should_be_deleted_children_first'), 'warning');
            return back();
        }
        $expense_section->delete();
        toast(trans('site.deleted successfully', ['attr' => trans_choice('site.sections', 0) ]),'success');
        return back();
    }

    public function forceDelete($id)
    {
        $expense_section = ExpenseSection::onlyTrashed()->findOrFail($id);
        if ($expense_section->payments->count() > 0) {
            toast(trans('site.should_be_deleted_children_first'), 'warning');
            return back();
        }

        $expense_section->forceDelete();
        toast(trans('site.deleted successfully', ['attr' => trans_choice('site.sections', 0)]),'error');
        return back();
    }

    public function restore($id)
    {
        $expense_section = ExpenseSection::onlyTrashed()->findOrFail($id);

        $expense_section->restore();
        toast(trans('site.restored successfully', ['attr' => trans_choice('site.sections', 0)]),'success');
        return back();
    }
}
