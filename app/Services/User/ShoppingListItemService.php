<?php

namespace App\Services\User;
use App\Models\ShoppingListItem;
class ShoppingListItemService
{
   function getAll()
    {
        return ShoppingListItem::all();
    }

    function getById($id)
    {
        return ShoppingListItem::findOrFail($id);
    }

    function create()
    {
        return new ShoppingListItem;
    }

    function update($id, array $data)
    {
        $recipe = ShoppingListItem::findOrFail($id);
        $recipe->update($data);
        return $recipe;
    }

    function delete($id)
    {
        $recipe = ShoppingListItem::findOrFail($id);
        $recipe->delete();
        return true;
    }
}
