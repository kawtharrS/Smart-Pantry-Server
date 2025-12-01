<?php

namespace App\Services\User;
use App\Models\MealPlan;
use App\Models\Recipe;

class MealPlanService
{
    function getAll()
    {
        return MealPlan::with('recipe')->get();
    }

    function getById($id)
    {
        return MealPlan::with('recipe' )->findOrFail($id);
    }
    
    function getByDay($day)
    {
        return MealPlan::where('day', $day)
                      ->with('recipe')
                      ->first(); 
    }

    function create()
    {
        return new MealPlan; 
    }

    function update($id, array $data)
    {
        $mealPlan = MealPlan::findOrFail($id);
        $mealPlan->update($data);
        return $mealPlan;
    }

    function delete($id)
    {
        $mealPlan = MealPlan::findOrFail($id);
        $mealPlan->delete();
        return true;
    }
}