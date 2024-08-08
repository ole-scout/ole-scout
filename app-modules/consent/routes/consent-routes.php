<?php

use FossHaas\Consent\Http\Controllers\ConsentController;
use FossHaas\Consent\Http\Middleware\ConsensualCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

ConsensualCookies::except('/consent');
VerifyCsrfToken::except('/consent');

Route::post('/consent', ConsentController::class)->name('consent');
