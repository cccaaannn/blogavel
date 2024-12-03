<?php

use App\Http\Controllers\LocaleController;
use Illuminate\Support\Facades\Route;

Route::post('locale', [LocaleController::class, 'changeLocale']);

