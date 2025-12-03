<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Services\User\ShoppingListService;

class ShoppingListController extends Controller
{
    public function __construct(protected ShoppingListService $shoppingListService)
    {}
    
    function getAllShoppingLists()
    {
        $items = $this->shoppingListService->getAll();
        return $this->responseJSON($items);
    }

    function show($id)
    {
        $item = $this->shoppingListService->getById($id);
        return $this->responseJSON($item);
    }

    function updateShoppingList(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'household_id' => 'sometimes|integer|exists:households,id',
            'is_active' => 'sometimes|boolean'
        ]);

        $item = $this->shoppingListService->update($id, $validated);
        
        if($item)
            return $this->responseJSON($item, "success", 200);
        
        return $this->responseJSON($item, "failure", 400);
    }

    function createShoppingList(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'household_id' => 'required|integer|exists:households,id',
            'is_active' => 'boolean'
        ]);
        
        $item = $this->shoppingListService->create();

        $item->name = $validated["name"];
        $item->household_id = $validated["household_id"];
        $item->is_active = $validated["is_active"];

        $item->save();

        if($item)
            return $this->responseJSON($item);
        
        return $this->responseJSON(null, "failure", 400);
    }

    function deleteShoppingList($id)
    {
        $item = $this->shoppingListService->delete($id);

        if($item)
            return $this->responseJSON($item, "success", 200);
        
        return $this->responseJSON(null, "failure", 400);
    }

    public function getWeeklyShoppingList(Request $request)
    {
        $validated = $request->validate([
            'household_id' => 'required|integer|exists:households,id',
            'days' => 'required|array',
        ]);

        $shoppingList = $this->shoppingListService->getWeeklyShoppingList(
            $validated['household_id'], 
            $validated['days']
        );
        
        return $this->responseJSON($shoppingList, 'success', 200);
    }
}