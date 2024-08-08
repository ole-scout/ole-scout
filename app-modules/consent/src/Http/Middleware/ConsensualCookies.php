<?php

namespace FossHaas\Consent\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\Concerns\ExcludesPaths;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Response;

class ConsensualCookies
{
    use ExcludesPaths;

    protected static $except = [];

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $sessionCookie = Config::get('session.cookie');
        if (
            $request->cookies->has('consent') ||
            $request->cookies->has($sessionCookie) ||
            $this->inExceptArray($request)
        ) {
            return $next($request);
        }
        // Config::set('session.driver', 'array');
        $response = $next($request);
        // $response->headers->removeCookie('XSRF-TOKEN');
        // $response->headers->removeCookie($sessionCookie);
        return $response;
    }

    /**
     * Get the URIs that should be excluded.
     *
     * @return array
     */
    public function getExcludedPaths()
    {
        return $this::$except ?? [];
    }

    /**
     * Indicate that the given URIs should be excluded.
     *
     * @param  array|string  $uris
     * @return void
     */
    public static function except(string|array $path): void
    {
        if (is_array($path)) {
            static::$except = array_merge(static::$except, $path);
            return;
        }
        static::$except[] = $path;
    }
}
