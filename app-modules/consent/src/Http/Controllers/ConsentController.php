<?php

namespace FossHaas\Consent\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;

class ConsentController
{
    /**
     * Store or update the resource.
     */
    public function store(Request $request)
    {
        $now = time();
        $previous = $request->consentCookie() ?: [];
        $validated = $request->validate([
            'services' => 'required|array',
            'services.*' => 'exists:service_definitions,id',
        ]);
        $consent = Arr::mapWithKeys(
            $validated['services'],
            fn($service) => [$service => (
                array_key_exists($service, $previous)
                ? $previous[$service]
                : $now
            )]
        );
        Cookie::queue('consent', json_encode($consent), 60 * 24 * 365);
        return response(status: 204);
    }

    /**
     * Display the resource.
     */
    public function show()
    {
        return view('consent::consent');
    }

    /**
     * Destroy the resource
     */
    public function destroy()
    {
        $sessionCookie = Config::get('session.cookie');
        Cookie::expire('consent');
        Cookie::expire($sessionCookie);
        Cookie::expire('XSRF-TOKEN');
        return response(status: 204);
    }
}
