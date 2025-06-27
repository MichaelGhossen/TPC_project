<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ConversionController;
use App\Http\Controllers\Api\ExpenseCategoryController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\ProductionSettingController;
use App\Http\Controllers\Api\ProductPatchController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RawMaterialController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductMaterialController;
use App\Http\Controllers\Api\RawMaterialPatchController;
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

Route::prefix('expense-categories')->group(function () {
    Route::get('/', [ExpenseCategoryController::class, 'index']);
    Route::post('/', [ExpenseCategoryController::class, 'store']);
    Route::get('{id}', [ExpenseCategoryController::class, 'show']);
    Route::put('/{id}', [ExpenseCategoryController::class, 'update']);
    Route::delete('{id}', [ExpenseCategoryController::class, 'destroy']);

});
Route::get('/search/expense-categories', [ExpenseCategoryController::class, 'searchByName']);

Route::get('/expenses', [ExpenseController::class, 'index']);
Route::post('/expenses', [ExpenseController::class, 'store']);
Route::get('/expenses/{id}', [ExpenseController::class, 'show']);
Route::put('/expenses/{id}', [ExpenseController::class, 'update']);
Route::delete('/expenses/{id}', [ExpenseController::class, 'destroy']);

Route::prefix('raw-materials')->group(function () {
    Route::get('/', [RawMaterialController::class, 'index']);
    Route::get('/{id}', [RawMaterialController::class, 'show']);
    Route::post('/', [RawMaterialController::class, 'store']);
    Route::put('/{id}', [RawMaterialController::class, 'update']);
    Route::delete('/{id}', [RawMaterialController::class, 'destroy']);
});
Route::get('search/raw-materials/', [RawMaterialController::class, 'search']);

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/{id}', [ProductController::class, 'show']);
    Route::post('/', [ProductController::class, 'store']);
    Route::put('/{id}', [ProductController::class, 'update']);
    Route::delete('/{id}', [ProductController::class, 'destroy']);
    Route::post('/update-products-prices', [ProductController::class, 'updateProductsPrices']);
});
Route::get('/search/products', [ProductController::class, 'search']);

Route::prefix('product-materials')->group(function () {
    Route::get('/', [ProductMaterialController::class, 'index']);
    Route::get('/search',[ProductMaterialController::class,'search']);
    Route::get('/{id}', [ProductMaterialController::class, 'show']);
    Route::put('/{id}', [ProductMaterialController::class, 'updateByProduct']);
    // Get all materials for a product
    Route::get('/by-product/{product_id}', [ProductMaterialController::class, 'getByProductId']);
});

Route::prefix('raw-material-batches')->group(function () {
    Route::get('/', [RawMaterialPatchController::class, 'index']);
    Route::get('/{id}', [RawMaterialPatchController::class, 'show']);
    Route::post('/', [RawMaterialPatchController::class, 'store']);
    Route::put('/{id}', [RawMaterialPatchController::class, 'update']);
    Route::delete('/{id}', [RawMaterialPatchController::class, 'destroy']);
});
Route::get('/by-raw-material/{raw_material_id}', [RawMaterialPatchController::class, 'getByRawMaterialId']);
Route::get('/search/raw-material-batches', [RawMaterialPatchController::class, 'search']);


Route::get('/by-month/expenses', [ExpenseController::class, 'getByMonth']);

Route::get('/production-settings', [ProductionSettingController::class, 'index']);
Route::post('/production-settings', [ProductionSettingController::class, 'store']);
Route::get('/production-settings/{id}', [ProductionSettingController::class, 'show']);
Route::put('/production-settings/{id}', [ProductionSettingController::class, 'update']);
Route::delete('/production-settings/{id}', [ProductionSettingController::class, 'destroy']);
Route::get('by-month/production-settings', [ProductionSettingController::class, 'getByMonth']);

Route::prefix('product-batches')->group(function () {
    Route::get('/search', [ProductPatchController::class, 'search']);
    Route::get('/by-product/{product_id}', [ProductPatchController::class, 'getByProductId']);
    Route::get('/', [ProductPatchController::class, 'index']);
    Route::get('/{id}', [ProductPatchController::class, 'show']);
    Route::post('/', [ProductPatchController::class, 'store']);
    Route::put('/{id}', [ProductPatchController::class, 'update']);
    Route::delete('/{id}', [ProductPatchController::class, 'destroy']);
});
Route::prefix('conversions')->group(function () {
    Route::get('/', [ConversionController::class, 'index']);
    Route::get('/search',[ConversionController::class, 'search']);
    Route::get('/{id}', [ConversionController::class, 'show']);
    Route::get('/by-product-batch/{id}', [ConversionController::class, 'getByProductBatchID']);
});

