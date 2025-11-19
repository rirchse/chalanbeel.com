<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Session::has('locale')) {
            $locale = Session::get('locale');
            if (in_array($locale, ['en', 'bn'])) {
                App::setLocale($locale);
            } else {
                App::setLocale('bn'); // Default to Bengali
            }
        } else {
            // Set Bengali as default if no session locale is set
            App::setLocale('bn');
            Session::put('locale', 'bn');
        }
        
        return $next($request);
    }
}
