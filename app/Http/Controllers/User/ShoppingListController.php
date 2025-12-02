<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\User\ShoppingListService;
class ShoppingListController extends Controller
{
       public function __construct(protected ShoppingListService $shoppingListService)
    {}
    function getAllshoppingLists()
    {
        $recipes = $this->shoppingListService->getAll();
        return $this->responseJSON($recipes);
    }

    function show($id)
    {
        $recipe = $this->shoppingListService->getById($id);
        return $this->responseJSON($recipe);
    }

    function updateshoppingList(Request $request, $id)
    {
        $recipe = $this->shoppingListService->update($id, $request->all());
        if($recipe)
            return $this->responseJSON($recipe, "success", 200);
        return $this->responseJSON($recipe, "failure", 400);
    }

    function createShoppingList(Request $request)
    {
        $recipe = $this->shoppingListService->create();
        $recipe->name = $request["name"];
        $recipe->email = $request["email"];
        $recipe->password = $request["password"];

        if($recipe->save())
            return $this->responseJSON($recipe);
        return $this->responseJSON(null, "failure", 400);
    }

    function deleteShoppingList($id)
    {
        $recipe = $this->shoppingListService->delete($id);
        if($recipe)
        {
            return $this->responseJSON($recipe, "success", 200);
        }
        return $this->responseJSON(null. "failure", 400);
    }

    public function getWeeklyShoppingList(Request $request)
    {
        $householdId = $request->query('household_id');

        if (!$householdId) {
            return $this->responseJSON(null, 'household_id is required', 400);
        }

        $weekDays = $request->query('days'); 

        $shoppingList = $this->shoppingListService->getWeeklyShoppingList($householdId, $weekDays);

        return $this->responseJSON($shoppingList, 'success', 200);
    }
}
