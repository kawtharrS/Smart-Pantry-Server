<?php

namespace App\Services\User;

use App\Models\MealPlan;
use App\Models\Recipe;

class MealPlanService
{
    function getAll($householdId)
    {
        return MealPlan::with('recipe.ingredients')
                       ->where('household_id', $householdId)
                       ->get();
    }

    function getById($id, $householdId)
    {
        return MealPlan::with('recipe.ingredients')
                       ->where('household_id', $householdId)
                       ->findOrFail($id);
    }
    
    function getByDay($day)
    {
        return MealPlan::where('day', $day)
                       ->with('recipe.ingredients')
                       ->first(); 
    }
    
    function getByDayAndHousehold($day, $householdId)
    {
        return MealPlan::where('day', $day)
                       ->where('household_id', $householdId)
                       ->with('recipe.ingredients')
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