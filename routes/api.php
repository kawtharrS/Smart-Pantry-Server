<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\HouseHoldController;


Route::group(["prefix"=>"user"], function(){
    Route::get('/users', [UserController::class, "getAllUsers"]);
    Route::get('/delete/{id}',[UserController::class, "deleteUser"] );
    Route::get('/user/{id}',[UserController::class, "show"] );
    Route::post('/add', [UserController::class, "createUser"]);
    Route::post('/update/{id}', [UserController::class, "updateUser"]);
});

Route::group(["prefix"=>"household"], function(){
    Route::get('/households', [HouseHoldController::class, "getAllHouseholds"]);
    Route::get('/delete/{id}',[HouseHoldController::class, "deleteHousehold"] );
    Route::get('/household/{id}',[HouseHoldController::class, "show"] );
    Route::post('/add', [HouseHoldController::class, "createHousehold"]);
    Route::post('/update/{id}', [HouseHoldController::class, "updateHousehold"]);
});



