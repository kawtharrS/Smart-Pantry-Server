<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\User\PantryItemsService;
class PantryItemsController extends Controller
{
    public function __construct(protected PantryItemsService $pantryItemsService)
    {}
    function getAllPantryItems()
    {
        $users = $this->pantryItemsService->getAllPantryItems();
        return $this->responseJSON($users);
    }

    function show($id)
    {
        $user = $this->pantryItemsService->getPantryItemById($id);
        return $this->responseJSON($user);
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
        $user = $this->pantryItemsService->create();
        $user->name = $request["name"];
        $user->email = $request["email"];
        $user->password = $request["password"];

        if($user->save())
            return $this->responseJSON($user);
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
