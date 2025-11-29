<?php

namespace App\Services\User;
use App\Models\ShoppingList;
class ShoppingListService
{
    function getAll()
    {
        return ShoppingList::all();
    }

    function getById($id)
    {
        return ShoppingList::findOrFail($id);
    }

    function create()
    {
        return new ShoppingList;
    }

    function update($id, array $data)
    {
        $recipe = ShoppingList::findOrFail($id);
        $recipe->update($data);
        return $recipe;
    }

    function delete($id)
    {
        $recipe = ShoppingList::findOrFail($id);
        $recipe->delete();
        return true;
    }
}
