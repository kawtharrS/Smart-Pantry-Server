<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;


Route::group(["prefix"=>"user"], function(){
    Route::get('/users', [UserController::class, "getAllUsers"]);
    Route::get('/delete/{id}',[UserController::class, "deleteUser"] );
    Route::get('/user/{id}',[UserController::class, "show"] );
    Route::post('/add', [UserController::class, "createUser"]);
    Route::post('/update/{id}', [UserController::class, "updateUser"]);
});



