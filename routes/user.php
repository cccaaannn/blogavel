<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/users/me', [UserController::class, 'profilePage']);
    Route::post('/users/avatar', [UserController::class, 'addAvatar']);
    Route::delete('/users/avatar', [UserController::class, 'deleteAvatar']);
});
