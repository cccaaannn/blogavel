<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


require __DIR__.'/auth.php';
require __DIR__.'/posts.php';
require __DIR__.'/user.php';
require __DIR__.'/locale.php';

Route::get('/', [HomeController::class, 'home']);

