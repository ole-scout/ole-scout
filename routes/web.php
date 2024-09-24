<?php

use FossHaas\Auth\Livewire\Authentication;
use Illuminate\Support\Facades\Route;

Route::get('/login', Authentication::class)->name('login');
