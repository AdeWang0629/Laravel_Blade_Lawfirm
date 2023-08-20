<?php
namespace App\Repository;


interface ExpenseSectionRepositoryInterface {
    // all ExpenseSections
    public function index();

    // all trashed ExpenseSections
    public function trashed();

    // store ExpenseSection
    public function store($request);

    // update ExpenseSection
    public function update($request, $expense_section);

    // delete ExpenseSection
    public function delete($expense_section);

    // forceDelete ExpenseSection
    public function forceDelete($id);

    // restore ExpenseSection
    public function restore($id);
}
