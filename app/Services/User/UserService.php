<?php

namespace App\Services\User;
use App\Models\User;
class UserService
{
    function getAll()
    {
        return User::all();
    }

    function getById($id)
    {
        return User::findOrFail($id);
    }

    function create()
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
