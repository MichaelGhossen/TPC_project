<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\NameController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RawMaterialController;
use App\Http\Controllers\Api\ProductController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
//for admin
Route::middleware('auth:sanctum')->get('/showAllUsers', [UserController::class, 'showAllUsers']);
Route::middleware('auth:sanctum')->put('/admin/users/{id}', [UserController::class, 'updateUserById']);



    Route::get('/user/show/{id}', [UserController::class, 'show']);//->middleware('auth:sanctum');;
    Route::put('/user/update/{id}', [UserController::class, 'update']);
    Route::delete('/user/delete/{id}', [UserController::class, 'destroy']);

