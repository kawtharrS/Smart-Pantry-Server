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
        $items = $this->shoppingListService->getAll();
        return $this->responseJSON($items);
    }

    function show($id)
    {
        $item = $this->shoppingListService->getById($id);
        return $this->responseJSON($item);
    }

    function updateshoppingList(Request $request, $id)
    {
        $item = $this->shoppingListService->update($id, $request->all());
        if($item)
            return $this->responseJSON($item, "success", 200);
        return $this->responseJSON($item, "failure", 400);
    }

    function createShoppingList(Request $request)
    {
        $item = $this->shoppingListService->create();
        $item->name = $request["name"];
        $item->email = $request["email"];
        $item->password = $request["password"];

        if($item->save())
            return $this->responseJSON($item);
        return $this->responseJSON(null, "failure", 400);
    }

    function deleteShoppingList($id)
    {
        $item = $this->shoppingListService->delete($id);
        if($item)
            return $this->responseJSON($item, "success", 200);
        
        return $this->responseJSON(null. "failure", 400);
    }

    public function getWeeklyShoppingList(Request $request)
    {
        $householdId = $request->query('household_id');

        if (!$householdId) 
            return $this->responseJSON(null, 'household_id is required', 400);
        

        $weekDays = $request->query('days'); 
        $shoppingList = $this->shoppingListService->getWeeklyShoppingList($householdId, $weekDays);
        return $this->responseJSON($shoppingList, 'success', 200);
    }
}
