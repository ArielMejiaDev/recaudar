<?php

namespace App\Providers;

use App\Models\Team;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Redirect;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
//    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/teams';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return RedirectResponse
     */
    public function boot()
    {
        //
        parent::boot();

        // To make work www urls, because router detect "www." as a team for subdomain route model binding
        if (Str::contains(url()->current(), 'www')) {
            return Redirect::to(
                Str::replaceFirst('www.', '', url()->current())
            )->send();
        }
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapAuthenticationRoutes();

        $this->mapProfileRoutes();

        $this->mapAdminRoutes();

        $this->mapTeamRoutes();

        //
    }

    /**
     * Define web admin routes for the application.
     *
     * @return void
     */
    protected function mapAdminRoutes()
    {
        Route::middleware('web')
            ->group(base_path('routes/admin/web.php'));
    }

    /**
     * Define web dashboard routes for the application.
     *
     * @return void
     */
    protected function mapTeamRoutes()
    {
        Route::middleware('web')
            ->group(base_path('routes/team/web.php'));
    }

    /**
     * Define web authentication routes for the application.
     *
     * @return void
     */
    protected function mapAuthenticationRoutes()
    {
        Route::middleware('web')
            ->group(base_path('routes/authentication/web.php'));
    }

    /**
     * Define web profile routes for the application.
     *
     * @return void
     */
    protected function mapProfileRoutes()
    {
        Route::middleware('web')
            ->group(base_path('routes/user/profile/profile.php'));
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
//            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }
}
