<?php

namespace App\Providers;

use App\User;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Registering custom UserProvider that contains the custom authentication logic
        Auth::provider('custom', function ($app, array $config) {
            return new CustomUserProvider($app->make(Hasher::class), $app->make(User::class));
        });
    }
}
