<?php

namespace App\Services\User;
use App\Models\ShoppingList;
use App\Models\MealPlan;
use Illuminate\Support\Facades\DB;
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
