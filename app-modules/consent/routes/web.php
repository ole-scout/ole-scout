<?php

use FossHaas\Consent\Http\Controllers\ConsentController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::post('/consent', ConsentController::class)
  ->withoutMiddleware(VerifyCsrfToken::class)
  ->name('consent');
