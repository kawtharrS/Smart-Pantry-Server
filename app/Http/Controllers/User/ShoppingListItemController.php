<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\User\ShoppingListItemService;

class ShoppingListItemController extends Controller
{
    public function __construct(protected ShoppingListItemService $shoppingListItemService)
    {}
    function getAllshoppingListItems()
    {
        $recipes = $this->shoppingListItemService->getAll();
        return $this->responseJSON($recipes);
    }

    function show($id)
    {
        $recipe = $this->shoppingListItemService->getById($id);
        return $this->responseJSON($recipe);
    }

    function updateshoppingListItem(Request $request, $id)
    {
        $recipe = $this->shoppingListItemService->update($id, $request->all());
        if($recipe)
            return $this->responseJSON($recipe, "success", 200);
        return $this->responseJSON($recipe, "failure", 400);
    }

    function createShoppingListItem(Request $request)
    {
        $recipe = $this->shoppingListItemService->create();
        $recipe->name = $request["name"];
        $recipe->email = $request["email"];
        $recipe->password = $request["password"];

        if($recipe->save())
            return $this->responseJSON($recipe);
        return $this->responseJSON(null, "failure", 400);
    }

    function deleteShoppingListItem($id)
    {
        $recipe = $this->shoppingListItemService->delete($id);
        if($recipe)
        {
            return $this->responseJSON($recipe, "success", 200);
        }
        return $this->responseJSON(null. "failure", 400);
    }
}
