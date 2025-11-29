<?php

namespace App\Services\User;
use App\Models\PantryItem;
class PantryItemsService
{
    function getAllPantryItems()
    {
        return PantryItem::all();
    }

    function getPantryItemById($id)
    {
        return PantryItem::findOrFail($id);
    }

    function create()
    {
        return new PantryItem;
    }

    function update($id, array $data)
    {
        $pantryItem = PantryItem::findOrFail($id);
        $pantryItem->update($data);
        return $pantryItem;
    }

    function delete($id)
    {
        $pantryItem = PantryItem::findOrFail($id);
        $pantryItem->delete();
        return true;
    }
}
