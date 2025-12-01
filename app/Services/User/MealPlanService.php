<?php

namespace App\Services\User;
use App\Models\MealPlan;
class MealPlanService
{
    function getAll()
    {
        return MealPlan::with('recipes')->get();
    }

    function getById($id)
    {
        return MealPlan::with('recipes')->findOrFail($id);

    }

    function create()
    {
        return new MealPlan;
    }

    function update($id, array $data)
    {
        $pantryItem = MealPlan::findOrFail($id);
        $pantryItem->update($data);
        return $pantryItem;
    }

    function delete($id)
    {
        $pantryItem = MealPlan::findOrFail($id);
        $pantryItem->delete();
        return true;
    }
}
