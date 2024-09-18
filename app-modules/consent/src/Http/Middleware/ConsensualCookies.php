<?php

namespace FossHaas\Consent\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Response;

class ConsensualCookies
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->cookies->has('consent')) {
            return $next($request);
        }
        $sessionCookie = Config::get('session.cookie');
        Config::set('session.driver', 'array');
        $response = $next($request);
        $response->headers->removeCookie('XSRF-TOKEN');
        $response->headers->removeCookie($sessionCookie);
        return $response;
    }
}
