<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LibraryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RewardController;
use App\Http\Controllers\Admin\SetoranController;
use App\Http\Controllers\Admin\BillingController;

// --- LOGIN ---
Route::get('/', [AdminController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AdminController::class, 'login'])->name('login.post');

Route::name('admin.')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/product', [ProductController::class, 'index'])->name('product.index');

    Route::get('/reward', [RewardController::class, 'index'])->name('reward.index');

    Route::get('/library', [LibraryController::class, 'index'])->name('library.index');

    Route::get('/setoran', [SetoranController::class, 'index'])->name('setoran.index');

    Route::get('/billing', [BillingController::class, 'index'])->name('billing.index');

    Route::get('/employee', [UserController::class, 'employeeIndex'])->name('employee.index');

    Route::get('/customers', [UserController::class, 'customerIndex'])->name('customers.index');

    Route::get('/location', [LocationController::class, 'index'])->name('location.index');

    Route::get('/logout', [AdminController::class, 'logout'])->name('logout');

});
