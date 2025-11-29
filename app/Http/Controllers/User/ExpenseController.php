<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\User\ExpenseService;
class ExpenseController extends Controller
{
    public function __construct(protected ExpenseService $expenseService)
    {}
    function getAllExpenses()
    {
        $users = $this->expenseService->getAll();
        return $this->responseJSON($users);
    }

    function show($id)
    {
        $user = $this->expenseService->getById($id);
        return $this->responseJSON($user);
    }

    function updateExpense(Request $request, $id)
    {
        $user = $this->expenseService->update($id, $request->all());
        if($user)
            return $this->responseJSON($user, "success", 200);
        return $this->responseJSON($user, "failure", 400);
    }

    function createExpense(Request $request)
    {
        $user = $this->expenseService->create();
        $user->name = $request["name"];
        $user->email = $request["email"];
        $user->password = $request["password"];

        if($user->save())
            return $this->responseJSON($user);
        return $this->responseJSON(null, "failure", 400);
    }

    function deleteExpense($id)
    {
        $user = $this->expenseService->delete($id);
        if($user)
        {
            return $this->responseJSON($user, "success", 200);
        }
        return $this->responseJSON(null. "failure", 400);
    }
}
