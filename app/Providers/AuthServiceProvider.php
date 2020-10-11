<?php

namespace App\Providers;

use App\Policies\ManageChargesPolicy;
use App\User;
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
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user) {
            if ($user->role === 'app_admin') {
                return true;
            }
        });

        Gate::define('manage-transactions', function ($user) {
            return $user->role === 'app_financial';
        });

        Gate::define('manage-teams', function ($user) {
            return $user->role === 'app_editor';
        });
    }
}
