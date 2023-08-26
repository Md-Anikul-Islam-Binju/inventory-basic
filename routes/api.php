<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\RecordExpenseController;
use App\Http\Controllers\api\UserAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [UserAuthController::class, 'login']);
Route::middleware(['auth:sanctum'])->group(function () {

    //category
    Route::get('/category', [CategoryController::class, 'index']);
    //product
    Route::post('/product-store', [ProductController::class, 'store']);
    //show product api with category
    Route::get('/product-show', [ProductController::class, 'show']);
    //sell product
    Route::post('/sell-product/{productId}', [ProductController::class, 'sellProduct']);
    //expense-record
    Route::post('/expense-record', [RecordExpenseController::class, 'store']);
    //expense-record-show
    Route::get('/expense-record-show', [RecordExpenseController::class, 'show']);

});
