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
        // Handle specific day query with household_id
        if ($request->has('day')) {
            $household_id = $request->query('household_id');
            
            if (!$household_id) {
                return $this->responseJSON([], "No household_id provided", 400);
            }
            
            $mealPlan = $this->mealPlanService->getByDayAndHousehold($request->day, $household_id);
            return $this->responseJSON($mealPlan);
        }
        
        // Handle all meal plans for household
        $household_id = $request->query("household_id");
        
        if (!$household_id) {
            return $this->responseJSON([], "No household_id provided", 400);
        }

        $mealPlans = $this->mealPlanService->getAll($household_id);
        return $this->responseJSON($mealPlans);
    }

    public function show(Request $request, $id)
    {
        $household_id = $request->user()->household_id;
        $mealPlan = $this->mealPlanService->getById($id, $household_id);
        return $this->responseJSON($mealPlan);
    }

    public function updateMealPlan(Request $request, $id)
    {
        $mealPlan = $this->mealPlanService->update($id, $request->all());
        
        if ($mealPlan) {
            $mealPlan->load('recipe.ingredients');
            return $this->responseJSON($mealPlan, "success", 200);
        }
        
        return $this->responseJSON(null, "failure", 400);
    }

    public function createMealPlan(Request $request)
    {
        // Check if meal plan exists for this day AND household
        $existingMealPlan = MealPlan::where('day', $request->day)
                                    ->where('household_id', $request->household_id)
                                    ->first();
        
        if ($existingMealPlan) {
            // Update existing meal plan
            $existingMealPlan->recipe_id = $request->recipe_id;
            
            if ($existingMealPlan->save()) {
                $existingMealPlan->load('recipe.ingredients');
                return $this->responseJSON($existingMealPlan);
            }
        } else {
            // Create new meal plan
            $meal = $this->mealPlanService->create();
            $meal->recipe_id = $request->recipe_id;
            $meal->household_id = $request->household_id;
            $meal->day = $request->day;

            if ($meal->save()) {
                $meal->load('recipe.ingredients');
                return $this->responseJSON($meal);
            }
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