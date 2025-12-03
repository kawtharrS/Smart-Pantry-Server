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
    function getWeeklyShoppingList($householdId, $weekDays)
    {
        $missing = [];

        // to get mealplans for the week
        $mealPlans = MealPlan::with(relations: 'recipe.ingredients')
                        ->where('household_id', $householdId)
                        ->whereIn('day', $weekDays)
                        ->get();
        // relationship mealplan ->recipes ->ingredients 
        foreach($mealPlans as $plan) {
            foreach($plan->recipe->ingredients as $ingredient) {
                $exists = DB::table('pantries_items')
                            ->where('household_id', $householdId)
                            ->where('ingredient_id', $ingredient->id)
                            ->exists();

                if(!$exists) {
                    if(isset($missing[$ingredient->id])) {
                        $missing[$ingredient->id]['quantity_needed'] += 1; 
                    } else {
                        $missing[$ingredient->id] = [
                            'id' => $ingredient->id,
                            'name' => $ingredient->name,
                            'unit_id' => $ingredient->unit_id,
                            'quantity_needed' => 1 
                        ];
                    }
                }
            }
        }

        return array_values($missing);
    }

}
