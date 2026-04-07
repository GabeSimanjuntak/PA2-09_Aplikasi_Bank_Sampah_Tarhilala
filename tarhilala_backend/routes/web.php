<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LibraryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\RewardController;
use App\Http\Controllers\Admin\SetoranController;
use App\Http\Controllers\Admin\BillingController;
use App\Http\Controllers\Admin\RouteController;
use App\Http\Controllers\Admin\ScheduleController;

// --- LOGIN ---
Route::get('/', [AdminController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AdminController::class, 'login'])->name('login.post');

Route::name('admin.')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::put('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');

    Route::get('/employee', [EmployeeController::class, 'index'])->name('employee.index');
    Route::post('/employee/store', [EmployeeController::class, 'store'])->name('employee.store');
    Route::put('/employee/update/{id}', [EmployeeController::class, 'update'])->name('employee.update');
    Route::delete('/employee/delete/{id}', [EmployeeController::class, 'destroy'])->name('employee.delete');

    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::post('/customers/store', [CustomerController::class, 'store'])->name('customers.store');
    Route::put('/customers/update/{id}', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/customers/delete/{id}', [CustomerController::class, 'destroy'])->name('customers.delete');

    Route::get('/reward', [RewardController::class, 'index'])->name('reward.index');
    Route::post('/reward/store', [RewardController::class, 'store'])->name('reward.store');
    Route::put('/reward/update/{id}', [RewardController::class, 'update'])->name('reward.update');
    Route::delete('/reward/delete/{id}', [RewardController::class, 'destroy'])->name('reward.delete');

    Route::get('/library', [LibraryController::class, 'index'])->name('library.index');
    Route::post('/library/store', [LibraryController::class, 'store'])->name('library.store');
    Route::put('/library/update/{id}', [LibraryController::class, 'update'])->name('library.update');
    Route::delete('/library/delete/{id}', [LibraryController::class, 'destroy'])->name('library.delete');

    Route::get('/setoran', [SetoranController::class, 'index'])->name('setoran.index');

    Route::get('/billing', [BillingController::class, 'index'])->name('billing.index');

    Route::get('/location', [LocationController::class, 'index'])->name('location.index');

    Route::post('/rute/store', [RouteController::class, 'store'])->name('rute.store');
    Route::put('/rute/update/{id}', [RouteController::class, 'update'])->name('rute.update');
    Route::delete('/rute/delete/{id}', [RouteController::class, 'destroy'])->name('rute.delete');

    Route::post('/jadwal/store', [ScheduleController::class, 'store'])->name('jadwal.store');
    Route::put('/jadwal/update/{id}', [ScheduleController::class, 'update'])->name('jadwal.update');
    Route::delete('/jadwal/delete/{id}', [ScheduleController::class, 'destroy'])->name('jadwal.delete');

    Route::get('/logout', [AdminController::class, 'logout'])->name('logout');

});
