<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\InstallmentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\PaylaterController;

Route::get('/', [DashboardController::class, 'index']);

Route::resource('products', ProductController::class);
Route::get('/cashier', [CashierController::class, 'index']);
Route::post('/cashier/checkout', [CashierController::class, 'checkout']);

Route::resource('members', MemberController::class);

Route::resource('suppliers', SupplierController::class);

Route::get('/installments', [InstallmentController::class, 'index']);
Route::post('/installments/pay/{id}', [InstallmentController::class, 'pay']);

Route::get('/savings-loans', [SavingsLoanController::class, 'index']);
Route::post('/savings-loans/store', [SavingsLoanController::class, 'store']);

Route::get('/reports', [ReportController::class, 'index']);


Route::get('/points', [PointController::class, 'index']);


Route::get('/paylater', [PaylaterController::class, 'index'])->name('paylater.index');
Route::post('/paylater/add-item', [PaylaterController::class, 'addItem'])->name('paylater.add-item');
