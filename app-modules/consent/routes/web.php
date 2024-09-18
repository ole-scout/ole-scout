<?php

use FossHaas\Consent\Http\Controllers\ConsentController;
use FossHaas\Consent\Settings\AppConsentSettings;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

Route::name('consent.')
  ->group(function () {
    if (!Schema::hasTable('settings')) return;
    $settings = app(AppConsentSettings::class);
    VerifyCsrfToken::except($settings->consent_url);
    Route::get($settings->consent_url, [ConsentController::class, 'show'])->name('show');
    Route::post($settings->consent_url, [ConsentController::class, 'store'])->name('store');
    Route::delete($settings->consent_url, [ConsentController::class, 'destroy'])->name('destroy');
  });
