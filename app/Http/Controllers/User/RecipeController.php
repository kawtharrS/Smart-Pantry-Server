<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Services\User\RecipeService;

class RecipeController extends Controller
{
    public function __construct(protected RecipeService $recipeService)
    {}
    
    function getAllRecipes(Request $request)
    {
        $validated = $request->validate([
            'household_id' => 'required|integer|exists:households,id'
        ]);
        
        $recipes = $this->recipeService->getAll($validated['household_id']);
        return $this->responseJSON($recipes);
    }

    function show(Request $request, $id)
    {
        $household_id = $request->user()->household_id; 
        $recipe = $this->recipeService->getById($id, $household_id);
        return $this->responseJSON($recipe);
    }

    function updateRecipe(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'prep_time_min' => 'sometimes|integer|min:0',
            'cook_time_min' => 'sometimes|integer|min:0',
            'serving' => 'sometimes|integer|min:1',
            'household_id' => 'sometimes|integer|exists:households,id',
            'user_id' => 'sometimes|integer|exists:users,id'
        ]);

        $recipe = $this->recipeService->update($id, $validated);
        
        if($recipe)
            return $this->responseJSON($recipe, "success", 200);
        
        return $this->responseJSON($recipe, "failure", 400);
    }

    function createRecipe(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'prep_time_min' => 'required|integer|min:0',
            'cook_time_min' => 'required|integer|min:0',
            'serving' => 'required|integer|min:1',
            'household_id' => 'required|integer|exists:households,id',
            'user_id' => 'required|integer|exists:users,id',
        ]);
        
        $recipe = $this->recipeService->create();

        $recipe->household_id = $validated["household_id"];
        $recipe->user_id = $validated["user_id"];
        $recipe->title = $validated["title"];
        $recipe->description = $validated["description"];
        $recipe->prep_time_min = $validated["prep_time_min"];
        $recipe->cook_time_min = $validated["cook_time_min"];
        $recipe->serving = $validated["serving"];

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
        return $this->responseJSON(null, "failure", 400); 
    }
}