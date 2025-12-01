<?php

namespace App\Services\User;
use App\Models\RecipesInstruction;
class RecipeIntruction
{
    function getAll()
    {
        return RecipesInstruction::all();
    }

    function getById($id)
    {
        return RecipesInstruction::findOrFail($id);
    }

    function create()
    {
        return new RecipesInstruction;
    }

    function update($id, array $data)
    {
        $recipe = RecipesInstruction::findOrFail($id);
        $recipe->update($data);
        return $recipe;
    }

    function delete($id)
    {
        $recipe = RecipesInstruction::findOrFail($id);
        $recipe->delete();
        return true;
    }
}
