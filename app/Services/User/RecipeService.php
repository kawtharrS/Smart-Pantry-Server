<?php

namespace App\Services\User;
use App\Models\Recipe;
class RecipeService
{
    function getAll()
    {
        return Recipe::with('ingredients')->get();
    }

    function getById($id)
    {
        return Recipe::with('ingredients')->findOrFail($id);
        
    }

    function create()
    {
        return new Recipe;
    }

    function update($id, array $data)
    {
        $recipe = Recipe::findOrFail($id);
        $recipe->update($data);
        return $recipe;
    }

    function delete($id)
    {
        $recipe = Recipe::findOrFail($id);
        $recipe->delete();
        return true;
    }
}
