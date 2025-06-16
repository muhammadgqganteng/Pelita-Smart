<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Listeners\LogUserRegistration;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }
protected $listen = [
    Registered::class => [
        LogUserRegistration::class,
    ],
];
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Gate::define("", function ($user, $ability) {   
        //    return $request->user()->role !== $role;
        // }); 
}
}