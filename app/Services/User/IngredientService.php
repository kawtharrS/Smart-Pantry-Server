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
        $Ingredient = Ingredient::findOrFail($id);
        $Ingredient->update($data);
        return $Ingredient;
    }

    function delete($id)
    {
        $Ingredient = Ingredient::findOrFail($id);
        $Ingredient->delete();
        return true;
    }
}
