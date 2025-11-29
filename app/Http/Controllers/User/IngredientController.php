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
        $user = $this->ingredientService->create();
        $user->name = $request["name"];
        $user->email = $request["email"];
        $user->password = $request["password"];

        if($user->save())
            return $this->responseJSON($user);
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
