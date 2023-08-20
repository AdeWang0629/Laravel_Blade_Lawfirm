<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExpenseSectionRequest;
use App\Models\ExpenseSection;
use App\Repository\ExpenseSectionRepositoryInterface;

class ExpenseSectionController extends Controller
{
    public $expenseSections;
    public function __construct(ExpenseSectionRepositoryInterface $expenseSections) {
        $this->expenseSections = $expenseSections;
        $this->middleware('permission:expenseSection_list|expenseSection_create|expenseSection_edit|expenseSection_delete|expenseSection_restore', ['only' => ['index']]);
        $this->middleware('permission:expenseSection_create', ['only' => ['store']]);
        $this->middleware('permission:expenseSection_edit', ['only' => ['update']]);
        $this->middleware('permission:expenseSection_delete', ['only' => ['forceDelete','destroy']]);
        $this->middleware('permission:expenseSection_restore', ['only' => ['restore']]);
    }

    public function index()
    {
        return $this->expenseSections->index();
    }

    public function trashed()
    {
        return $this->expenseSections->trashed();
    }

    public function store(ExpenseSectionRequest $request)
    {
        return $this->expenseSections->store($request);
    }

    public function update(ExpenseSectionRequest $request,ExpenseSection $expense_section)
    {
        return $this->expenseSections->update($request, $expense_section);
    }

    public function destroy(ExpenseSection $expense_section)
    {
        return $this->expenseSections->delete($expense_section);
    }

    public function forceDelete($id)
    {
        return $this->expenseSections->forceDelete($id);
    }

    public function restore($id)
    {
        return $this->expenseSections->restore($id);
    }
}
