<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\User\MealPlanService;
use App\Models\MealPlan;

class MealPlanController extends Controller
{
    public function __construct(protected MealPlanService $mealPlanService)
    {}
    
    public function getAllMealPlans(Request $request)
    {
        if ($request->has('day')) {
            $mealPlan = $this->mealPlanService->getByDay($request->day);
            return $this->responseJSON($mealPlan);
        }

        $household_id = $request->query("household_id");

        if(!$household_id)
            return $this->responseJSON([], "No household_id provided", 400);
        
        $mealPlans = $this->mealPlanService->getAll($household_id);
        return $this->responseJSON($mealPlans);
    }

    public function show(Request $request, $id)
    {
        //$user = Auth::user();
        $household_id = $request->user()->household_id;
        $mealPlan = $this->mealPlanService->getById($id, $household_id);
        return $this->responseJSON($mealPlan);
    }

    public function updateMealPlan(Request $request, $id)
    {
        $validated = $request->validate([
            'recipe_id' => 'sometimes|integer|exists:recipes,id',
            'household_id' => 'sometimes|integer|exists:households,id',
            'day' => 'required'
        ]);

        $mealPlan = $this->mealPlanService->update($id, $validated);
        
        if ($mealPlan) {
            $mealPlan->load('recipe.ingredients');
            return $this->responseJSON($mealPlan, "success", 200);
        }
        
        return $this->responseJSON(null, "failure", 400);
    }

    public function createMealPlan(Request $request)
    {
        $validated = $request->validate([
            'recipe_id' => 'required|integer|exists:recipes,id',
            'household_id' => 'required|integer|exists:households,id',
            'day' => 'required'
        ]);

        $mealPlan = $this->mealPlanService->createOrUpdateForDay(
            $validated['day'],
            $validated['household_id'],
            $validated['recipe_id']
        );
        
        if ($mealPlan) {
            return $this->responseJSON($mealPlan);
        }
        
        return $this->responseJSON(null, "failure", 400);
    }

    public function deleteMealPlan($id)
    {
        $result = $this->mealPlanService->delete($id);
        
        if ($result) {
            return $this->responseJSON(["message" => "Deleted successfully"], "success", 200);
        }
        
        return $this->responseJSON(null, "failure", 400);
    }
}