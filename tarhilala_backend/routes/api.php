<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdminAuthController;
use App\Http\Controllers\Api\UserAuthController;

Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/user/login', [UserAuthController::class, 'login']);
Route::post('/user/register', [UserAuthController::class, 'register']);

Route::middleware('auth:sanctum')->get('/profile', function (Request $request) {
    return $request->user();
});
