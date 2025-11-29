<?php

namespace App\Services\User;
use App\Models\ExpesesItem;
class ExpenseItemService
{
     function getAll()
    {
        return ExpesesItem::all();
    }

    function getById($id)
    {
        return ExpesesItem::findOrFail($id);
    }

    function create()
    {
        return new ExpesesItem;
    }

    function update($id, array $data)
    {
        $pantryItem = ExpesesItem::findOrFail($id);
        $pantryItem->update($data);
        return $pantryItem;
    }

    function delete($id)
    {
        $pantryItem = ExpesesItem::findOrFail($id);
        $pantryItem->delete();
        return true;
    }
}
