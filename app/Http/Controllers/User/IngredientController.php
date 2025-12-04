<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\User\IngredientService;

class IngredientController extends Controller
{
    public function __construct(protected IngredientService $ingredientService)
    {}
    
    function getAllIngredients()
    {
        $ingredients = $this->ingredientService->getAllIngredients();
        return $this->responseJSON($ingredients);
    }

    function show($id)
    {
        $ingredient = $this->ingredientService->getIngredientById($id);
        return $this->responseJSON($ingredient);
    }

    function updateIngredient(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'unit_id' => 'sometimes|integer|exists:units,id',
            'caloriesPer100g' => 'sometimes|numeric|min:0',
            'proteinPer100g' => 'sometimes|numeric|min:0',
            'fatsPer100g' => 'sometimes|numeric|min:0',
            'carbsPer100g' => 'sometimes|numeric|min:0',
            'expiry_date' => 'sometimes|date|after:today',
            'quantity' => 'sometimes|numeric|min:0'
        ]);

        $ingredient = $this->ingredientService->update($id, $validated);
        
        if($ingredient)
            return $this->responseJSON($ingredient, "success", 200);
        
        return $this->responseJSON($ingredient, "failure", 400);
    }

    function createIngredient(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'unit_id' => 'required|integer|exists:units,id',
            'caloriesPer100g' => 'required|numeric|min:0',
            'proteinPer100g' => 'required|numeric|min:0',
            'fatsPer100g' => 'required|numeric|min:0',
            'carbsPer100g' => 'required|numeric|min:0',
            'expiry_date' => 'sometimes|date',
            'quantity' => 'sometimes|numeric|min:0'
        ]);
        
        $ingredient = $this->ingredientService->create();
        
        $ingredient->name = $validated["name"];
        $ingredient->unit_id = $validated["unit_id"];
        $ingredient->caloriesPer100g = $validated["caloriesPer100g"];
        $ingredient->proteinPer100g = $validated["proteinPer100g"];
        $ingredient->fatsPer100g = $validated["fatsPer100g"];
        $ingredient->carbsPer100g = $validated["carbsPer100g"];
        $ingredient->expiry_date = $validated["expiry_date"] ?? null;
        $ingredient->quantity = $validated["quantity"] ?? 0;

        if($ingredient->save())
            return $this->responseJSON($ingredient);
        return $this->responseJSON(null, "failure", 400);
    }

    function deleteIngredient($id)
    {
        $ingredient = $this->ingredientService->delete($id);
        if($ingredient)
        {
            return $this->responseJSON($ingredient, "success", 200);
        }
        return $this->responseJSON(null, "failure", 400); 
    }
}