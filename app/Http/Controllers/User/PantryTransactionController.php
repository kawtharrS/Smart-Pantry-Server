<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\User\PantryTransactionService;
class PantryTransactionController extends Controller
{
    public function __construct(protected PantryTransactionService $pantryTransactionService)
    {}
    function getAllPantryTransaction()
    {
        $users = $this->pantryTransactionService->getAll();
        return $this->responseJSON($users);
    }

    function show($id)
    {
        $user = $this->pantryTransactionService->getById($id);
        return $this->responseJSON($user);
    }

    function updatePantryTransaction(Request $request, $id)
    {
        $user = $this->pantryTransactionService->update($id, $request->all());
        if($user)
            return $this->responseJSON($user, "success", 200);
        return $this->responseJSON($user, "failure", 400);
    }

    function createPantryTransaction(Request $request)
    {
        $user = $this->pantryTransactionService->create();
        $user->name = $request["name"];
        $user->email = $request["email"];
        $user->password = $request["password"];

        if($user->save())
            return $this->responseJSON($user);
        return $this->responseJSON(null, "failure", 400);
    }

    function deletePantryTransaction($id)
    {
        $user = $this->pantryTransactionService->delete($id);
        if($user)
        {
            return $this->responseJSON($user, "success", 200);
        }
        return $this->responseJSON(null. "failure", 400);
    }
}
