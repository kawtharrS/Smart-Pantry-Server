<?php

namespace App\Services\User;
use App\Models\User;
class UserService
{
    function getAllUsers()
    {
        return User::all();
    }

    function getUserById($id)
    {
        return User::findOrFail($id);
    }

    function craete()
    {
        return new User;
    }

    function update($id, array $data)
    {
        $user = User::findOrFail($id);
        $user->update($data);
        return $user;
    }

    function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return true;
    }
    
}
