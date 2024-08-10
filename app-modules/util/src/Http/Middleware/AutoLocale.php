<?php

namespace FossHaas\Util\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class AutoLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $available = array_keys(config('util.locales'));
        $lang = $request->getPreferredLanguage($available);
        if ($lang) App::setLocale($lang);
        return $next($request);
    }
}
