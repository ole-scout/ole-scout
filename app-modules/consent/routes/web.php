<?php

use FossHaas\Consent\Http\Controllers\ConsentController;
use FossHaas\Consent\Settings\AppConsentSettings;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::name('consent.')
  ->group(function () {
    $settings = app(AppConsentSettings::class);
    VerifyCsrfToken::except($settings->consent_url);
    Route::post($settings->consent_url, ConsentController::class)
      ->name('store');
  });
