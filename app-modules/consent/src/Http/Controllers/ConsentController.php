<?php

namespace FossHaas\Consent\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cookie;

class ConsentController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        Cookie::queue('consent', 'ok', 60 * 24 * 365);
        $payload = $request->all();
        $request->session()->put('consent', [
            'services' => Arr::mapWithKeys(
                $payload,
                fn ($services, $key) => [
                    $key => Arr::map(
                        $services,
                        fn ($value) => $value === true ? time() : null
                    )
                ]
            )
        ]);
        return response(status: 204);
    }
}
