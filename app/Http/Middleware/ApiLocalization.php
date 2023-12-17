<?php

namespace App\Http\Middleware;

use Closure;

class ApiLocalization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $locale = $request->header('Accept-Language');
        if(!$locale){
            $locale = config('app.locale');
        }

        if (! array_key_exists($locale, config('app.supported_languages'))) {
            app()->setLocale(config('app.locale'));
        }

        app()->setLocale($locale);

        $response = $next($request);

        $response->headers->set('Accept-Language', $locale);

        return $response;
    }
}
