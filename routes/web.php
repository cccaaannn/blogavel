<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


require __DIR__.'/auth.php';
require __DIR__.'/posts.php';
Route::get('/', [HomeController::class, 'home']);

