<?php

namespace FossHaas\Consent\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cookie;

class ConsentController
{
    /**
     * Store or update the resource.
     */
    public function store(Request $request)
    {
        $payload = $request->all();
        $now = time();
        $previous = $request->consentCookie() ?: [];
        $consent = Arr::mapWithKeys(
            $payload,
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
}
