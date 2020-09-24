<?php

namespace App\Providers;

use App\Models\Team;
use App\Observers\TeamObserver;
use App\Observers\UserObserver;
use App\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

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
        User::observe(UserObserver::class);
        Team::observe(TeamObserver::class);
        Paginator::useTailwind();
    }
}
