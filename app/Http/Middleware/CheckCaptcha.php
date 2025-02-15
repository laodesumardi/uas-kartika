<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckCaptcha
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Jika methodnya adalah POST dan route-nya adalah login
        if ($request->isMethod('post') && $request->routeIs('login')) {
            // Validasi CAPTCHA
            $request->validate([
                'captcha' => 'required|captcha'
            ], [
                'captcha.captcha' => 'CAPTCHA yang dimasukkan salah.'
            ]);
        }

        return $next($request);
    }
}
