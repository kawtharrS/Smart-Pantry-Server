<?php

namespace App\Services\User;
use App\Models\RecipeInstruction;
class RecipeIntruction
{
    function getAll()
    {
        return RecipeInstruction::all();
    }

    function getById($id)
    {
        return RecipeInstruction::findOrFail($id);
    }

    function create()
    {
        return new RecipeInstruction;
    }

    function update($id, array $data)
    {
        $recipe = RecipeInstruction::findOrFail($id);
        $recipe->update($data);
        return $recipe;
    }

    function delete($id)
    {
        $recipe = RecipeInstruction::findOrFail($id);
        $recipe->delete();
        return true;
    }
}
