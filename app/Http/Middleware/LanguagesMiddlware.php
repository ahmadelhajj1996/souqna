<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LanguagesMiddlware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle($request, Closure $next)
    {
        $supportedLanguages = ['en', 'ar'];
        $locale = $request->header('Accept-Language', 'ar');

        if (!in_array($locale, $supportedLanguages)) {
            $locale = 'ar';
        }
        app()->setLocale($locale);

        return $next($request);
    }
}
