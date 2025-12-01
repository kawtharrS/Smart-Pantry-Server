<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\User\RecipeService;
class RecipeController extends Controller
{
   public function __construct(protected RecipeService $recipeService)
    {}
    function getAllRecipes()
    {
        $recipes = $this->recipeService->getAll();
        return $this->responseJSON($recipes);
    }

    function show($id)
    {
        $recipe = $this->recipeService->getById($id);
        return $this->responseJSON($recipe);
    }

    function updateRecipe(Request $request, $id)
    {
        $recipe = $this->recipeService->update($id, $request->all());
        if($recipe)
            return $this->responseJSON($recipe, "success", 200);
        return $this->responseJSON($recipe, "failure", 400);
    }

    function createRecipe(Request $request)
    {
        $recipe = $this->recipeService->create();
        $recipe->household_id = $request["household_id"];
        $recipe->user_id=$request["user_id"];
        $recipe->title = $request["title"];
        $recipe->description = $request["description"];
        $recipe->prep_time_min = $request["prep_time_min"];
        $recipe->cook_time_min = $request["cook_time_min"];
        $recipe->serving = $request["serving"];

        if($recipe->save())
            return $this->responseJSON($recipe);
        return $this->responseJSON(null, "failure", 400);
    }

    function deleteRecipe($id)
    {
        $recipe = $this->recipeService->delete($id);
        if($recipe)
        {
            return $this->responseJSON($recipe, "success", 200);
        }
        return $this->responseJSON(null. "failure", 400);
    }
}
