<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role)
    {

        
        if (! $request->user() || $request->user()->role === $role) {
            return $next($request);

        }
            abort(403, 'Unauthorized.');

    }
    
// alur ke app boostrap dan buat alias middleware seterusnya buat logic di app/Providers/AppServiceProvider.php
    // protected $routeMiddleware = [
    //     'auth' => \App\Http\Middleware\Authenticate::class,
    //     'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
    //     'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
    //     'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    //     'role' => \App\Http\Middleware\CheckRole::class, // Tambahkan baris ini
    // ];
}
