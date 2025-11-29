<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\User\ExpenseItemService;

class ExpenseItemController extends Controller
{
    public function __construct(protected ExpenseItemService $expenseItemService)
    {}
    function getAllExpenseItems()
    {
        $users = $this->expenseItemService->getAll();
        return $this->responseJSON($users);
    }

    function show($id)
    {
        $user = $this->expenseItemService->getById($id);
        return $this->responseJSON($user);
    }

    function updateExpenseItem(Request $request, $id)
    {
        $user = $this->expenseItemService->update($id, $request->all());
        if($user)
            return $this->responseJSON($user, "success", 200);
        return $this->responseJSON($user, "failure", 400);
    }

    function createExpenseItem(Request $request)
    {
        $user = $this->expenseItemService->create();
        $user->name = $request["name"];
        $user->email = $request["email"];
        $user->password = $request["password"];

        if($user->save())
            return $this->responseJSON($user);
        return $this->responseJSON(null, "failure", 400);
    }

    function deleteExpenseItem($id)
    {
        $user = $this->expenseItemService->delete($id);
        if($user)
        {
            return $this->responseJSON($user, "success", 200);
        }
        return $this->responseJSON(null. "failure", 400);
    }
}
