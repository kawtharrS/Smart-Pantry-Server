<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\User\MealplanItemService;
class MealPlanItemController extends Controller
{
    public function __construct(protected MealplanItemService $mealplanItemService)
    {}
    function getAllMealPlanItems()
    {
        $users = $this->mealplanItemService->getAll();
        return $this->responseJSON($users);
    }

    function show($id)
    {
        $user = $this->mealplanItemService->getById($id);
        return $this->responseJSON($user);
    }

    function updateMealPlanItem(Request $request, $id)
    {
        $user = $this->mealplanItemService->update($id, $request->all());
        if($user)
            return $this->responseJSON($user, "success", 200);
        return $this->responseJSON($user, "failure", 400);
    }

    function createMealPlanItem(Request $request)
    {
        $user = $this->mealplanItemService->create();
        $user->name = $request["name"];
        $user->email = $request["email"];
        $user->password = $request["password"];

        if($user->save())
            return $this->responseJSON($user);
        return $this->responseJSON(null, "failure", 400);
    }

    function deleteMealPlanItem($id)
    {
        $user = $this->mealplanItemService->delete($id);
        if($user)
        {
            return $this->responseJSON($user, "success", 200);
        }
        return $this->responseJSON(null. "failure", 400);
    }
}
