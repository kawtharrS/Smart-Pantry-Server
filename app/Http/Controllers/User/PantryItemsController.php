<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\User\PantryItemsService;
class PantryItemsController extends Controller
{
    public function __construct(protected PantryItemsService $pantryItemsService)
    {}
    public function getAllPantryItems(Request $request)
    {
        $householdId = $request->query('household_id');

        if (!$householdId) {
            return $this->responseJSON([], "No household_id provided", 400);
        }

        $items = $this->pantryItemsService->getAllPantryItemsByHousehold($householdId);

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
        $user = $this->pantryItemsService->update($id, $request->all());
        if($user)
            return $this->responseJSON($user, "success", 200);
        return $this->responseJSON($user, "failure", 400);
    }

    function createPantryItem(Request $request)
    {
        
        $item = $this->pantryItemsService->create();
        $item->household_id = $request["household_id"];
        $item->ingredient_id = $request["ingredient_id"];
        $item->unit_id = $request["unit_id"];
        $item->quantity = $request["quantity"];
        $item->location = $request["location"];
        $item->expiry_date = $request["expiry_date"];

        if($item->save())
            return $this->responseJSON($item);
        return $this->responseJSON(null, "failure", 400);
    }

    function deletePantryItem($id)
    {
        $user = $this->pantryItemsService->delete($id);
        if($user)
        {
            return $this->responseJSON($user, "success", 200);
        }
        return $this->responseJSON(null. "failure", 400);
    }
}
