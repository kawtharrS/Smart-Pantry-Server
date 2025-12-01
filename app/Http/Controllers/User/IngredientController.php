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
        $users = $this->ingredientService->getAllIngredients();
        return $this->responseJSON($users);
    }

    function show($id)
    {
        $user = $this->ingredientService->getIngredientById($id);
        return $this->responseJSON($user);
    }

    function updateIngredient(Request $request, $id)
    {
        $user = $this->ingredientService->update($id, $request->all());
        if($user)
            return $this->responseJSON($user, "success", 200);
        return $this->responseJSON($user, "failure", 400);
    }

    function createIngredient(Request $request)
    {
        $ingredient = $this->ingredientService->create();
        $ingredient->name = $request["name"];
        $ingredient->unit_id = $request["unit_id"];
        $ingredient->caloriesPer100g = $request["caloriesPer100g"];
        $ingredient->proteinPer100g = $request["proteinPer100g"];
        $ingredient->fatsPer100g = $request["fatsPer100g"];
        $ingredient->carbsPer100g = $request["carbsPer100g"];
        $ingredient->expiry_date = $request["expiry_date"];
        $ingredient->quantity = $request["quantity"];

        if($ingredient->save())
            return $this->responseJSON($ingredient);
        return $this->responseJSON(null, "failure", 400);
    }

    function deleteIngredient($id)
    {
        $user = $this->ingredientService->delete($id);
        if($user)
        {
            return $this->responseJSON($user, "success", 200);
        }
        return $this->responseJSON(null. "failure", 400);
    }
}
