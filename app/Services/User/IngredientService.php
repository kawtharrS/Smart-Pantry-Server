<?php

namespace App\Services\User;
use App\Models\Ingredient;
class IngredientService
{
    function getAllIngredients()
    {
        return Ingredient::all();
    }

    function getIngredientById($id)
    {
        return Ingredient::findOrFail($id);
    }

    function create()
    {
        return new Ingredient;
    }

    function update($id, array $data)
    {
        $ingredient = Ingredient::findOrFail($id);
        $ingredient->update($data);
        return $ingredient;
    }

    function delete($id)
    {
        $ingredient = Ingredient::findOrFail($id);
        $ingredient->delete();
        return true;
    }
}
