<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ExpenseController;
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

    Route::prefix('raw-materials')->group(function () {
        Route::get('/', [RawMaterialController::class, 'index']);
        Route::post('/', [RawMaterialController::class, 'store']);
        Route::get('/{id}', [RawMaterialController::class, 'show']);
        Route::put('/{id}', [RawMaterialController::class, 'update']);
        Route::delete('/{id}', [RawMaterialController::class, 'destroy']);

        // 🔍 Search by name & status
        Route::get('/search/by-name', [RawMaterialController::class, 'search']);
    });


Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::post('/', [ProductController::class, 'store']);
    Route::get('/{id}', [ProductController::class, 'show']);
    Route::put('/{id}', [ProductController::class, 'update']);
    Route::delete('/{id}', [ProductController::class, 'destroy']);

    // 🔍 Search by name & price (optional extension)
    Route::get('/search/by-name', [ProductController::class, 'search']);
});


Route::prefix('expenses')->group(function () {
    Route::get('/', [ExpenseController::class, 'index']);
    Route::post('/', [ExpenseController::class, 'store']);
    Route::get('/{id}', [ExpenseController::class, 'show']);
    Route::put('/{id}', [ExpenseController::class, 'update']);
    Route::delete('/{id}', [ExpenseController::class, 'destroy']);
});
