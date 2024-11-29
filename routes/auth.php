<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/register', [AuthController::class, 'onRegister']);

Route::get('/auth/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth/login', [AuthController::class, 'onLogin']);

Route::post('/auth/logout', [AuthController::class, 'onLogout']);
