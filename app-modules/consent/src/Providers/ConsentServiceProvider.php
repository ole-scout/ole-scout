<?php

namespace FossHaas\Consent\Providers;

use FossHaas\Consent\Settings\AppConsentSettings;
use FossHaas\Consent\Http\Middleware\ConsensualCookies;
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
                $settings = app(AppConsentSettings::class);
                if (array_key_exists($service, $settings->service_ids)) {
                    $service = $settings->service_ids[$service];
                } else {
                    trigger_error('Unknown service name: ' . $service, E_USER_WARNING);
                    $service = null;
                }
            }
            $consent = $request->consentCookie();
            if ($consent !== null) {
                if (!$service) return true;
                return isset($consent[$service]);
            }
            if (ConsensualCookies::isExcluded($request)) {
                if (!$service) return true;
                return false;
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
