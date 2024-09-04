<?php

use FossHaas\Auth\Livewire\Authentication;
use Illuminate\Support\Facades\Route;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/login', Authentication::class)->name('login');
