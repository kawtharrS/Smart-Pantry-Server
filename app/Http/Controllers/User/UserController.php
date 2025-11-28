<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\User\UserService;

class UserController extends Controller
{
    public function __construct(protected UserService $userService)
    {}
    function getAllUsers()
    {
        $users = $this->userService->getAllUsers();
        return $this->responseJSON($users);
    }

    function show($id)
    {
        $user = $this->userService->getUserById($id);
        return $this->responseJSON($user);
    }

    function updateUser(Request $request, $id)
    {
        $user = $this->userService->update($id, $request->all());
        if($user)
            return $this->responseJSON($user, "success", 200);
        return $this->responseJSON($user, "failure", 400);
    }

    function createUser(Request $request)
    {
        $user = $this->userService->create();
        $user->name = $request["name"];
        $user->email = $request["email"];
        $user->password = $request["password"];

        if($user->save())
            return $this->responseJSON($user);
        return $this->responseJSON(null, "failure", 400);
    }

    function deleteUser($id)
    {
        $user = $this->userService->delete($id);
        if($user)
        {
            return $this->responseJSON($user, "success", 200);
        }
        return $this->responseJSON(null. "failure", 400);
    }

}
