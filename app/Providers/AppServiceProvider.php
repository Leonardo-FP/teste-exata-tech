<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Inertia::share([
            'auth.user' => function () {
                if (Auth::check()) {
                    return [
                        'id' => Auth::user()->id,
                        'name' => Auth::user()->name,
                        'email' => Auth::user()->email,
                        'roles' => Auth::user()->getRoleNames(), 
                        'permissions' => Auth::user()->getAllPermissions()->pluck('name'), 
                    ];
                }

                return null;
            },
        ]);
    }
}
