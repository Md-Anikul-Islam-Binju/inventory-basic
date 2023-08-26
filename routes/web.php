<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ExpenseCategoryController;
use App\Http\Controllers\admin\ManufactureController;
use App\Http\Controllers\admin\PurchaseVendorController;
use App\Http\Controllers\admin\RecordExpenseController;
use App\Http\Controllers\admin\StockController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\admin\ProductController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [AdminUserController::class, 'home'])->name('home');
// Routes accessible only to authenticated users
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminUserController::class, 'dashboard'])->name('dashboard');
    //category
    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::put('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');

    //expense
    Route::get('/expense/category', [ExpenseCategoryController::class, 'index'])->name('expense.category');
    Route::post('/expense/category/store', [ExpenseCategoryController::class, 'store'])->name('expense.category.store');
    Route::put('/expense/category/update/{id}', [ExpenseCategoryController::class, 'update'])->name('expense.category.update');
    Route::get('/expense/category/delete/{id}', [ExpenseCategoryController::class, 'destroy'])->name('expense.category.delete');

    //manufacture
    Route::get('/manufacture', [ManufactureController::class, 'index'])->name('manufacture');
    Route::post('/manufacture/store', [ManufactureController::class, 'store'])->name('manufacture.store');
    Route::put('/manufacture/update/{id}', [ManufactureController::class, 'update'])->name('manufacture.update');
    Route::get('/manufacture/delete/{id}', [ManufactureController::class, 'destroy'])->name('manufacture.delete');

    //purchase
    Route::get('/purchase', [PurchaseVendorController::class, 'index'])->name('purchase');
    Route::post('/purchase/store', [PurchaseVendorController::class, 'store'])->name('purchase.store');
    Route::put('/purchase/update/{id}', [PurchaseVendorController::class, 'update'])->name('purchase.update');
    Route::get('/purchase/delete/{id}', [PurchaseVendorController::class, 'destroy'])->name('purchase.delete');


    //user act like admin
    Route::get('/user', [AdminUserController::class, 'user'])->name('user');
    Route::post('/user/store', [AdminUserController::class, 'userStore'])->name('user.store');
    Route::put('/user/update/{id}', [AdminUserController::class, 'userUpdate'])->name('user.update');
    Route::get('/user/delete/{id}', [AdminUserController::class, 'userDelete'])->name('user.delete');

    //product
    Route::get('/product', [ProductController::class, 'show'])->name('product.show');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::put('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::get('/product/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');
    Route::get('/product/sellHistory', [ProductController::class, 'sellProductHistory'])->name('product.sellHistory');

    //product-invoice
    Route::get('/product/invoice/{id}', [ProductController::class, 'productInvoice'])->name('product.invoice');

    //expense-record
    Route::get('/expense-record', [RecordExpenseController::class, 'show'])->name('expense.record');
    Route::post('/expense-record/store', [RecordExpenseController::class, 'store'])->name('expense.record.store');
    Route::put('/expense-record/update/{id}', [RecordExpenseController::class, 'update'])->name('expense.record.update');
    Route::get('/expense-record/delete/{id}', [RecordExpenseController::class, 'destroy'])->name('expense.delete');

    //Stock to sell
    Route::put('/stock/update/{id}', [StockController::class, 'updateStock'])->name('stock.update');
    Route::get('/stock', [StockController::class, 'index'])->name('stock');
    Route::get('/stock/sell/{id}', [StockController::class, 'sell'])->name('product.sell');

    //cart
    Route::post('/cart/add', [StockController::class, 'add'])->name('cart.add');
    Route::get('/cart/show', [StockController::class, 'show'])->name('cart.show');
    Route::post('/cart/checkout', [StockController::class,'processCheckout'])->name('cart.processCheckout');

    //export
    Route::get('/product/sell-history/export', [ProductController::class,'exportProductSellHistory'])->name('product.sellHistory.export');


});


require __DIR__.'/auth.php';
