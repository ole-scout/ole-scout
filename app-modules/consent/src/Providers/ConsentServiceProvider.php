<?php

namespace FossHaas\Consent\Providers;

use FossHaas\Consent\Settings\AppConsentSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class ConsentServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        /**
         * @return array<int>|null
         */
        Request::macro('consentCookie', function (): ?array {
            $request = request();
            if (!$request->cookies->has('consent')) return null;
            return json_decode(
                $request->cookie('consent', '[]'),
                associative: true
            );
        });

        /**
         * @param string|int|null $service
         */
        Request::macro('consent', function (mixed $service = null): bool {
            $request = request();

            if (is_string($service)) {
                // resolve service name to id
                $settings = app(AppConsentSettings::class);
                if (array_key_exists($service, $settings->service_ids)) {
                    $service = $settings->service_ids[$service];
                } else {
                    trigger_error('Unknown service name: ' . $service, E_USER_WARNING);
                    $service = null;
                }
            }

            // check for consent
            $consent = $request->consentCookie();
            if ($service) return isset($consent[$service]);
            if ($consent !== null) return true;

            // check whether URL is exempt from consent
            $exemptUrls = $settings->excludedUrls();
            foreach ($exemptUrls as $url) {
                if ($url !== '/') {
                    $url = trim($url, '/');
                }

                if ($request->fullUrlIs($url) || $request->is($url)) {
                    return true;
                }
            }
            return false;
        });

        /**
         * @param string|int|null $service
         */
        Blade::if('consentgiven', function (mixed $service = null): bool {
            return request()->consent($service);
        });
    }
}
