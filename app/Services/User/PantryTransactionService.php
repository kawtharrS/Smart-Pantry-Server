<?php

namespace App\Services\User;
use App\Models\PantryTransaction;
class PantryTransactionService
{
    function getAll()
    {
        return PantryTransaction::all();
    }

    function getById($id)
    {
        return PantryTransaction::findOrFail($id);
    }

    function create()
    {
        return new PantryTransaction;
    }

    function update($id, array $data)
    {
        $pantryItem = PantryTransaction::findOrFail($id);
        $pantryItem->update($data);
        return $pantryItem;
    }

    function delete($id)
    {
        $pantryItem = PantryTransaction::findOrFail($id);
        $pantryItem->delete();
        return true;
    }
}
