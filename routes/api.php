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
Route::middleware('auth:sanctum')->get('/showAllUsers', [UserController::class, 'showAllUsers']);
Route::middleware('auth:sanctum')->put('/admin/users/{id}', [UserController::class, 'updateUserById']);



    Route::get('/user/show/{id}', [UserController::class, 'show']);//->middleware('auth:sanctum');;
    Route::put('/user/update/{id}', [UserController::class, 'update']);
    Route::delete('/user/delete/{id}', [UserController::class, 'destroy']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/names', [NameController::class, 'index']);
        Route::get('/name/{id}', [NameController::class, 'show']);

        //  only for admin:
        Route::post('/name/store', [NameController::class, 'store']);
        Route::put('/name/{id}', [NameController::class, 'update']);
        Route::delete('/name/{id}', [NameController::class, 'destroy']);
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/raw-materials', [RawMaterialController::class, 'index']);
        Route::post('/raw-materials', [RawMaterialController::class, 'store']);
        Route::get('/raw-materials/{id}', [RawMaterialController::class, 'show']);
        Route::put('/raw-materials/{id}', [RawMaterialController::class, 'update']);
        Route::delete('/raw-materials/{id}', [RawMaterialController::class, 'destroy']);
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/products', [ProductController::class, 'index']);
        Route::post('/products', [ProductController::class, 'store']);
        Route::get('/products/{id}', [ProductController::class, 'show']);
        Route::put('/products/{id}', [ProductController::class, 'update']);
        Route::delete('/products/{id}', [ProductController::class, 'destroy']);
    });
