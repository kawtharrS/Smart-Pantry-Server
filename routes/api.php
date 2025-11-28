<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;

Route::get('/users', [UserController::class, "index"]);
