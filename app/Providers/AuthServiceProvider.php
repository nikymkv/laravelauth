<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {

        $this->defineSuperAdmin();
        $this->defineAutoDiscover();
    }

    private function defineAutoDiscover()
    {
        Gate::guessPolicyNamesUsing(function ($class) {
            return \str_replace('\\Models\\', '\\Policies\\', $class) . 'Policy';
        });
    }

    private function defineSuperAdmin()
    {
        Gate::before(function ($user) {
            return $user->hasRole('super-admin') ? true : null;
        });
    }
}
