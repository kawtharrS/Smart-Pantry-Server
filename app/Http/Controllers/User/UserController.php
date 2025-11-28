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
    function index()
    {
        $users = $this->userService->getAllUsers();
        return response()->json($users);
    }

    function show(string $id)
    {
        
    }
}
