<?php

namespace App\Services\User;
use App\Models\RecipeIngredient;
class RecipeIngredientService
{
   function getAll()
    {
        return RecipeIngredient::all();
    }

    function getById($id)
    {
        return RecipeIngredient::findOrFail($id);
    }

    function create()
    {
        return new RecipeIngredient;
    }

    function update($id, array $data)
    {
        $recipe = RecipeIngredient::findOrFail($id);
        $recipe->update($data);
        return $recipe;
    }

    function delete($id)
    {
        $recipe = RecipeIngredient::findOrFail($id);
        $recipe->delete();
        return true;
    }
}
