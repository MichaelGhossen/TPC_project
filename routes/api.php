<?php

use App\Http\Controllers\Api\ActivityLogController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ConversionController;
use App\Http\Controllers\Api\DamagedMaterialController;
use App\Http\Controllers\Api\ExpenseCategoryController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\ProductionSettingController;
use App\Http\Controllers\Api\ProductPatchController;
use App\Http\Controllers\Api\ProductSaleController;
use App\Http\Controllers\Api\ProductSummaryReportController;
use App\Http\Controllers\Api\ProfitLossReportController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RawMaterialController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductMaterialController;
use App\Http\Controllers\Api\RawMaterialPatchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NotificationController;

//No Middlewares Needed
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Routes in Common
Route::middleware(['auth:sanctum', 'active'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::put('/user/update/{id}', [UserController::class, 'update']);
    Route::get('/user/show/{id}', [UserController::class, 'show']);

    Route::get('/notifications', [NotificationController::class, 'index']);
    Route::put('/notifications/read-all', [NotificationController::class, 'markAllAsRead']);
    Route::put('/notifications/{id}/read', [NotificationController::class, 'markAsRead']);

    Route::get('/expense-categories', [ExpenseCategoryController::class, 'index']);
    Route::get('expense-categories/search', [ExpenseCategoryController::class, 'searchByName']);
    Route::get('expense-categories/{id}', [ExpenseCategoryController::class, 'show']);

    Route::get('/expenses', [ExpenseController::class, 'index']);
    Route::get('/expenses/search',[ExpenseController::class, 'searchByCategoryName']);
    Route::get('/expenses/by-month', [ExpenseController::class, 'getByMonth']);
    Route::get('/expenses/by-category/{id}', [ExpenseController::class, 'getByCategoryId']);
    Route::get('/expenses/{id}', [ExpenseController::class, 'show']);

    Route::get('/production-settings', [ProductionSettingController::class, 'index']);
    Route::get('/production-settings/{id}', [ProductionSettingController::class, 'show']);
    Route::get('/by-month/production-settings', [ProductionSettingController::class, 'getByMonth']);

    Route::get('/product-sales', [ProductSaleController::class, 'index']);
    Route::get('/product-sales/monthly-sales', [ProductSaleController::class, 'getMonthlySales']);
    Route::get('/product-sales/search', [ProductSaleController::class, 'search']);
    Route::get('/product-sales/by-product-id/{id}', [ProductSaleController::class, 'getByProductId']);
    Route::get('/product-sales/by-product-batch-id/{id}', [ProductSaleController::class, 'getByProductBatchId']);
    Route::get('/product-sales/{id}', [ProductSaleController::class, 'show']);

    Route::prefix('/profit-loss-report')->group(function () {
        Route::get('/', [ProfitLossReportController::class, 'index']);
        Route::get('/search', [ProfitLossReportController::class, 'search']);
        Route::get('/{id}', [ProfitLossReportController::class, 'show']);
    });

    Route::prefix('/product-summary-reports')->group(function () {
        Route::get('/', [ProductSummaryReportController::class, 'index']);
        Route::get('/monthlyProfit', [ProductSummaryReportController::class, 'getMonthlyProfit']);
        Route::get('/search', [ProductSummaryReportController::class, 'search']);
        Route::get('/{id}', [ProductSummaryReportController::class, 'show']);
        Route::put('/refresh-report/{id}', [ProductSummaryReportController::class, 'refreshReport']);
        Route::put('/refresh-all-reports', [ProductSummaryReportController::class, 'refreshAllReports']);
    });

    Route::get('/raw-materials', [RawMaterialController::class, 'index']);
    Route::get('/raw-materials/get-used-materials',[RawMaterialController::class,'getUsedMaterials']);
    Route::get('/raw-materials/count', [RawMaterialController::class, 'materialsCount']);
    Route::get('/raw-materials/{id}', [RawMaterialController::class, 'show']);
    Route::get('search/raw-materials/', [RawMaterialController::class, 'search']);

    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/semi-finished-products', [ProductController::class, 'getSemiFinishedProducts']);
    Route::get('/products/count', [ProductController::class, 'productsCount']);
    Route::get('/products/{id}', [ProductController::class, 'show']);
    Route::post('/products/update-products-prices', [ProductController::class, 'updateProductsPrices']);
    Route::get('/search/products', [ProductController::class, 'search']);

    Route::get('/product-materials', [ProductMaterialController::class, 'index']);
    Route::get('/product-materials/search', [ProductMaterialController::class, 'search']);
    Route::get('/product-materials/{id}', [ProductMaterialController::class, 'show']);
    Route::get('/product-materials/by-product/{product_id}', [ProductMaterialController::class, 'getByProductId']);

    Route::get('/raw-material-batches', [RawMaterialPatchController::class, 'index']);
    Route::get('/raw-material-batches/{id}', [RawMaterialPatchController::class, 'show']);
    Route::get('/by-raw-material/{raw_material_id}', [RawMaterialPatchController::class, 'getByRawMaterialId']);
    Route::get('/search/raw-material-batches', [RawMaterialPatchController::class, 'search']);

    Route::get('/product-batches/search', [ProductPatchController::class, 'search']);
    Route::get('/product-batches/by-product/{product_id}', [ProductPatchController::class, 'getByProductId']);
    Route::get('/product-batches', [ProductPatchController::class, 'index']);
    Route::get('/product-batches/{id}', [ProductPatchController::class, 'show']);

    Route::prefix('conversions')->group(function () {
        Route::get('/', [ConversionController::class, 'index']);
        Route::get('/search', [ConversionController::class, 'search']);
        Route::get('/{id}', [ConversionController::class, 'show']);
        Route::get('/by-product-batch/{id}', [ConversionController::class, 'getByProductBatchID']);
    });

    Route::get('/damaged-materials', [DamagedMaterialController::class, 'index']);
    Route::get('/damaged-materials/search', [DamagedMaterialController::class, 'search']);
    Route::get('/damaged-materials/by-product-id/{id}', [DamagedMaterialController::class, 'getByProductId']);
    Route::get('/damaged-materials/by-raw-material-id/{id}', [DamagedMaterialController::class, 'getByRawMaterialId']);
    Route::get('/damaged-materials/{id}', [DamagedMaterialController::class, 'show']);

});

// Admin Routes
Route::middleware(['auth:sanctum', 'user.role:admin', 'active'])->group(function () {

    Route::get('/showAllUsers', [UserController::class, 'showAllUsers']);
    Route::put('/admin/users/{id}', [UserController::class, 'updateUserById']);
    Route::delete('/user/delete/{id}', [UserController::class, 'destroy']);
    Route::put('/admin/change-user-activation/{id}', [UserController::class, 'changeUserActivation']);

    Route::get('activity-logs', [ActivityLogController::class, 'index']);
    Route::get('activity-logs/{id}', [ActivityLogController::class, 'show']);
    Route::get('{model}/{id}/activity-logs', [ActivityLogController::class, 'forSubject']);
});

// Accountant Routes
Route::middleware(['auth:sanctum', 'user.role:accountant,admin', 'active'])->group(function () {

    Route::prefix('expense-categories')->group(function () {
        Route::post('/', [ExpenseCategoryController::class, 'store']);
        Route::put('/{id}', [ExpenseCategoryController::class, 'update']);
        Route::delete('{id}', [ExpenseCategoryController::class, 'destroy']);
    });

    Route::post('/expenses', [ExpenseController::class, 'store']);
    Route::put('/expenses/{id}', [ExpenseController::class, 'update']);
    Route::delete('/expenses/{id}', [ExpenseController::class, 'destroy']);

    Route::post('/production-settings', [ProductionSettingController::class, 'store']);
    Route::put('/production-settings/{id}', [ProductionSettingController::class, 'update']);
    Route::delete('/production-settings/{id}', [ProductionSettingController::class, 'destroy']);

    Route::prefix('/product-sales')->group(function () {
        Route::post('/', [ProductSaleController::class, 'store']);
        Route::put('/{id}', [ProductSaleController::class, 'update']);
        Route::delete('/{id}', [ProductSaleController::class, 'destroy']);
    });

});

// Warehouse Keeper Routes
Route::middleware(['auth:sanctum', 'user.role:warehouse_keeper,admin', 'active'])->group(function () {
    Route::prefix('raw-materials')->group(function () {
        Route::post('/', [RawMaterialController::class, 'store']);
        Route::put('/{id}', [RawMaterialController::class, 'update']);
        Route::delete('/{id}', [RawMaterialController::class, 'destroy']);
    });

    Route::prefix('products')->group(function () {
        Route::post('/', [ProductController::class, 'store']);
        Route::put('/{id}', [ProductController::class, 'update']);
        Route::delete('/{id}', [ProductController::class, 'destroy']);
    });

    Route::prefix('product-materials')->group(function () {
        Route::put('/{id}', [ProductMaterialController::class, 'updateByProduct']);
    });

    Route::prefix('raw-material-batches')->group(function () {
        Route::post('/', [RawMaterialPatchController::class, 'store']);
        Route::put('/{id}', [RawMaterialPatchController::class, 'update']);
        Route::delete('/{id}', [RawMaterialPatchController::class, 'destroy']);
    });

    Route::prefix('product-batches')->group(function () {
        Route::post('/', [ProductPatchController::class, 'store']);
        Route::put('/{id}', [ProductPatchController::class, 'update']);
        Route::delete('/{id}', [ProductPatchController::class, 'destroy']);
    });


    Route::prefix('/damaged-materials')->group(function () {
        Route::post('/', [DamagedMaterialController::class, 'store']);
        Route::put('/{id}', [DamagedMaterialController::class, 'update']);
        Route::delete('/{id}', [DamagedMaterialController::class, 'destroy']);
    });


});

