<?php

namespace App\Services\User;
use App\Models\Expense;
class ExpenseService
{
     function getAll()
    {
        return Expense::all();
    }

    function getById($id)
    {
        return Expense::findOrFail($id);
    }

    function create()
    {
        return new Expense;
    }

    function update($id, array $data)
    {
        $pantryItem = Expense::findOrFail($id);
        $pantryItem->update($data);
        return $pantryItem;
    }

    function delete($id)
    {
        $pantryItem = Expense::findOrFail($id);
        $pantryItem->delete();
        return true;
    }
}
