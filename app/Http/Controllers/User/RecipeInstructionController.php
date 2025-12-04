<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\User\RecipeIntruction;
class RecipeInstructionController extends Controller
{
   public function __construct(protected RecipeIntruction $recipeIntruction)
    {}
    function getAllRecipesInstruction()
    {
        $recipes = $this->recipeIntruction->getAll();
        return $this->responseJSON($recipes);
    }

    function show($id)
    {
        $recipe = $this->recipeIntruction->getById($id);
        return $this->responseJSON($recipe);
    }

    function updateRecipesInstruction(Request $request, $id)
    {
        $recipe = $this->recipeIntruction->update($id, $request->all());
        if($recipe)
            return $this->responseJSON($recipe, "success", 200);
        return $this->responseJSON($recipe, "failure", 400);
    }

    function createRecipesInstruction(Request $request)
    {
        $recipe = $this->recipeIntruction->create();
        $recipe->recipe_id = $request["recipe_id"];
        $recipe->stepNb = $request["stepNb"];
        $recipe->instruction = $request["instruction"];

        if($recipe->save())
            return $this->responseJSON($recipe);
        return $this->responseJSON(null, "failure", 400);
    }

    function deleteRecipesInstruction($id)
    {
        $recipe = $this->recipeIntruction->delete($id);
        if($recipe)
        {
            return $this->responseJSON($recipe, "success", 200);
        }
        return $this->responseJSON(null. "failure", 400);
    }
}
