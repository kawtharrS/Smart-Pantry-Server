<?php

namespace App\Services\User;
use App\Models\Recipe;
class RecipeService
{
    function getAll($householdId)
    {
        return Recipe::with('ingredients')->where('household_id',$householdId)->get();
    }

    function getById($id, $householdId)
    {
        return Recipe::with('ingredients')->where("household_id",$householdId)->findOrFail($id);
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
