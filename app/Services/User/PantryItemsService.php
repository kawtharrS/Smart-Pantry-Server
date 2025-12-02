<?php

namespace App\Services\User;

use App\Models\PantriesItem;
use App\Models\Ingredient;

class PantryItemsService
{
    function getAllPantryItems()
    {
        return PantriesItem::with('ingredient')->get();
    }

    function getPantryItemById($id)
    {
        return PantriesItem::with('ingredient')->findOrFail($id);
    }

public function create()
{
    return new PantriesItem();
  
}



    function update($id, array $data)
    {
        $pantryItem = PantriesItem::findOrFail($id);
        $pantryItem->update($data);
        return $pantryItem;
    }

    function delete($id)
    {
        $pantryItem = PantriesItem::findOrFail($id);
        $pantryItem->delete();
        return true;
    }
}
