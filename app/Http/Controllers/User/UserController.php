<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Services\User\UserService;

class UserController extends Controller
{
    public function __construct(protected UserService $userService)
    {}
    
    function getAllUsers()
    {
        $users = $this->userService->getAll();
        return $this->responseJSON($users);
    }

    function show($id)
    {
        $user = $this->userService->getById($id);
        return $this->responseJSON($user);
    }

    function updateUser(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => [
                'sometimes',
                'email',
                'max:255',
                Rule::unique('users')->ignore($id)
            ],
            'password' => 'sometimes|string|min:6',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        }

        $user = $this->userService->update($id, $validated);
        
        if($user)
            return $this->responseJSON($user, "success", 200);
        
        return $this->responseJSON($user, "failure", 400);
    }

    function createUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
        $user = $this->userService->create();

        $user->name= $validated["name"];
        $user->email= $validated["email"];
        $user->password=bcrypt($validated['password']);;

        $user->save();

        if($user)
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
        return $this->responseJSON(null, "failure", 400); 
    }

}