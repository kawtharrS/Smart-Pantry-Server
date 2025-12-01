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
        
        $mealPlans = $this->mealPlanService->getAll();
        return $this->responseJSON($mealPlans);
    }

    public function show($id)
    {
        $mealPlan = $this->mealPlanService->getById($id);
        return $this->responseJSON($mealPlan);
    }

    public function updateMealPlan(Request $request, $id)
    {
        $mealPlan = $this->mealPlanService->update($id, $request->all());
        
        if($mealPlan) {
            $mealPlan->load('recipe');
            return $this->responseJSON($mealPlan, "success", 200);
        }
        
        return $this->responseJSON(null, "failure", 400);
    }

    public function createMealPlan(Request $request)
    {
        $existingMealPlan = MealPlan::where('day', $request->day)->first();
        
        if ($existingMealPlan) {
            $existingMealPlan->recipe_id = $request->recipe_id;
            $existingMealPlan->household_id = $request->household_id;
            
            if($existingMealPlan->save()) {
                $existingMealPlan->load('recipe');
                return $this->responseJSON($existingMealPlan);
            }
        } else {
            $meal = $this->mealPlanService->create();
            $meal->recipe_id = $request->recipe_id;
            $meal->household_id = $request->household_id;
            $meal->day = $request->day;

            if($meal->save()) {
                $meal->load('recipe');
                return $this->responseJSON($meal);
            }
        }
        
        return $this->responseJSON(null, "failure", 400);
    }

    public function deleteMealPlan($id)
    {
        $result = $this->mealPlanService->delete($id);
        
        if($result) {
            return $this->responseJSON(["message" => "Deleted successfully"], "success", 200);
        }
        
        return $this->responseJSON(null, "failure", 400);
    }
}