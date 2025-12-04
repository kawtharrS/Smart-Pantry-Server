<?php

namespace App\Services\User;
use App\Models\RecipesIngredient;
class RecipeIngredientService
{
   function getAll()
    {
        return RecipesIngredient::all();
    }

    function getById($id)
    {
        return RecipesIngredient::findOrFail($id);
    }

    function create()
    {
        return new RecipesIngredient;
    }

    function update($id, array $data)
    {
        $recipe = RecipesIngredient::findOrFail($id);
        $recipe->update($data);
        return $recipe;
    }

    function delete($id)
    {
        $recipe = RecipesIngredient::findOrFail($id);
        $recipe->delete();
        return true;
    }
}
