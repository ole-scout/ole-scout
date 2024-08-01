<?php

namespace FossUndHaas\Consent\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ConsentController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        Cookie::queue('consent', 'ok', 60 * 24 * 30);
        return response(status: 204);
    }
}
