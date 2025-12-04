<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Services\User\PantryItemsService;

class PantryItemsController extends Controller
{
    public function __construct(protected PantryItemsService $pantryItemsService)
    {}
    
    public function getAllPantryItems(Request $request)
    {
        $validated = $request->validate([
            'household_id' => 'required|integer|exists:households,id'
        ]);

        $items = $this->pantryItemsService->getAllPantryItemsByHousehold($validated['household_id']);
        return $this->responseJSON($items);
    }

    public function show(Request $request, $id)
    {
        $householdId = $request->user()->household_id;
        $item = $this->pantryItemsService->getPantryItemByIdAndHousehold($id, $householdId);
        return $this->responseJSON($item);
    }

    function updatePantryItem(Request $request, $id)
    {
        $validated = $request->validate([
            'household_id' => 'sometimes|integer|exists:households,id',
            'ingredient_id' => 'sometimes|integer|exists:ingredients,id',
            'unit_id' => 'sometimes|integer|exists:units,id',
            'quantity' => 'sometimes|numeric|min:0',
            'location' => 'sometimes|string|max:255',
            'expiry_date' => 'sometimes|date|after:today'
        ]);

        $item = $this->pantryItemsService->update($id, $validated);
        
        if($item)
            return $this->responseJSON($item, "success", 200);
        
        return $this->responseJSON($item, "failure", 400);
    }

    function createPantryItem(Request $request)
    {
        $validated = $request->validate([
            'household_id' => 'required|integer|exists:households,id',
            'ingredient_id' => 'required|integer|exists:ingredients,id',
            'unit_id' => 'required|integer|exists:units,id',
            'quantity' => 'required|numeric|min:0',
            'location' => 'sometimes|string|max:255',
            'expiry_date' => 'sometimes|date|after:today'
        ]);
        
        $item = $this->pantryItemsService->create();

        $item->household_id = $validated["household_id"];
        $item->ingredient_id = $validated["ingredient_id"];
        $item->unit_id = $validated["unit_id"];
        $item->quantity = $validated["quantity"];
        $item->location = $validated["location"] ?? null;
        $item->expiry_date = $validated["expiry_date"] ?? null;

        if($item->save())
            return $this->responseJSON($item);
        return $this->responseJSON(null, "failure", 400);
    }

    function deletePantryItem($id)
    {
        $item = $this->pantryItemsService->delete($id);
        if($item)
        {
            return $this->responseJSON($item, "success", 200);
        }
        return $this->responseJSON(null, "failure", 400); 
    }
}