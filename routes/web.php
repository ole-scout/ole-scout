<?php

use App\Http\Controllers\ConsentController;
use Illuminate\Support\Facades\Route;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::post('/consent', ConsentController::class);
