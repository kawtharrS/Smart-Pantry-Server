<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\User\MealPlanService;

class MealPlanController extends Controller
{
    public function __construct(protected MealPlanService $mealPlanService)
    {}
    function getAllMealPlans()
    {
        $users = $this->mealPlanService->getAll();
        return $this->responseJSON($users);
    }

    function show($id)
    {
        $user = $this->mealPlanService->getById($id);
        return $this->responseJSON($user);
    }

    function updateMealPlan(Request $request, $id)
    {
        $user = $this->mealPlanService->update($id, $request->all());
        if($user)
            return $this->responseJSON($user, "success", 200);
        return $this->responseJSON($user, "failure", 400);
    }

    function createMealPlan(Request $request)
    {
        $user = $this->mealPlanService->create();
        $user->name = $request["name"];
        $user->email = $request["email"];
        $user->password = $request["password"];

        if($user->save())
            return $this->responseJSON($user);
        return $this->responseJSON(null, "failure", 400);
    }

    function deleteMealPlan($id)
    {
        $user = $this->mealPlanService->delete($id);
        if($user)
        {
            return $this->responseJSON($user, "success", 200);
        }
        return $this->responseJSON(null. "failure", 400);
    }
}
