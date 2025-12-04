<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\User\RecipeIngredientService;
class RecipeIngredientcontroller extends Controller
{
    public function __construct(protected RecipeIngredientService $recipeIngredientService)
    {}
    function getAllRecipesIngredient()
    {
        $recipes = $this->recipeIngredientService->getAll();
        return $this->responseJSON($recipes);
    }

    function show($id)
    {
        $recipe = $this->recipeIngredientService->getById($id);
        return $this->responseJSON($recipe);
    }

    function updateRecipesIngredient(Request $request, $id)
    {
        $recipe = $this->recipeIngredientService->update($id, $request->all());
        if($recipe)
            return $this->responseJSON($recipe, "success", 200);
        return $this->responseJSON($recipe, "failure", 400);
    }

    function createRecipesIngredient(Request $request)
    {
        $recipe = $this->recipeIngredientService->create();
        $recipe->recipe_id = $request["recipe_id"];
        $recipe->ingredient_id = $request["ingredient_id"];
        $recipe->unit_id = $request["unit_id"];
        $recipe->quantity = $request["quantity"];

        if($recipe->save())
            return $this->responseJSON($recipe);
        return $this->responseJSON(null, "failure", 400);
    }

    function deleteRecipesIngredient($id)
    {
        $recipe = $this->recipeIngredientService->delete($id);
        if($recipe)
        {
            return $this->responseJSON($recipe, "success", 200);
        }
        return $this->responseJSON(null. "failure", 400);
    }
}
