<?php

namespace App\Services\User;
use App\Models\ShoppingList;
use App\Models\MealPlan;
use Illuminate\Support\Facades\DB;
class ShoppingListService
{
    function getAll()
    {
        return ShoppingList::all();
    }

    function getById($id)
    {
        return ShoppingList::findOrFail($id);
    }

    function create()
    {
        return new ShoppingList;
    }

    function update($id, array $data)
    {
        $recipe = ShoppingList::findOrFail($id);
        $recipe->update($data);
        return $recipe;
    }

    function delete($id)
    {
        $recipe = ShoppingList::findOrFail($id);
        $recipe->delete();
        return true;
    }
         function getWeeklyShoppingList($householdId, $weekDays = null)
    {
        // Default to all days of the week
        $weekDays = $weekDays ?? ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];

        $missingIngredients = [];

        // Load meal plans with recipes and ingredients
        $mealPlans = MealPlan::with('recipe.ingredients')
                        ->where('household_id', $householdId)
                        ->whereIn('day', $weekDays)
                        ->get();

        foreach($mealPlans as $plan) {
            foreach($plan->recipe->ingredients as $ingredient) {
                $exists = DB::table('household_ingredients')
                            ->where('household_id', $householdId)
                            ->where('ingredient_id', $ingredient->id)
                            ->exists();

                if(!$exists) {
                    if(isset($missingIngredients[$ingredient->id])) {
                        $missingIngredients[$ingredient->id]['quantity_needed'] += 1; 
                    } else {
                        $missingIngredients[$ingredient->id] = [
                            'id' => $ingredient->id,
                            'name' => $ingredient->name,
                            'unit_id' => $ingredient->unit_id,
                            'quantity_needed' => 1 
                        ];
                    }
                }
            }
        }

        return array_values($missingIngredients);
    }

}
