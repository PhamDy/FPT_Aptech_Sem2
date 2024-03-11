<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('permission', function ($user) {
            return $user->type === 'admin';
        });

        Gate::define('staff-permission', function ($user) {
            return $user->type === 'staff';
        });

        Gate::define('user-permission', function ($user) {
            return $user->type === 'user';
        });
    }
}
