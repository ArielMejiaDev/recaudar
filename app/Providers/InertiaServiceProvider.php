<?php

namespace App\Providers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\UrlWindow;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Illuminate\Support\ServiceProvider;

class InertiaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootCacheBusting();
        $this->bootSharedProperties();
    }

    /**
     * Boot cache busting.
     *
     * @return void
     */
    protected function bootCacheBusting()
    {
        Inertia::version(function () {
            return md5_file(public_path('mix-manifest.json'));
        });
    }

    /**
     * Boot shared properties.
     *
     * @return void
     */
    protected function bootSharedProperties()
    {
        Inertia::share([
            'appName' => config('app.name'),
            'team' => request()->team,
            'auth' => function () {
                return [
                    'user' => Auth::user(),
                ];
            },
            'flash' => function () {
                return [
                    'success' => Session::get('success'),
                    'info' => Session::get('info'),
                    'message' => Session::get('message'),
                    'warning' => Session::get('warning'),
                    'danger' => Session::get('danger'),
                ];
            },
            'errors' => function () {
                return $this->sharedValidationErrors();
            },
            'global_trans' => [
                'home' => trans('Home'),
                'profile' => trans('Profile'),
                'teams' => trans('Teams'),
                'team' => trans('Team'),
                'team_profile' => trans('Team Profile'),
                'plans' => trans('Plans'),
                'transactions' => trans('Transactions'),
                'charges' => trans('Charges'),
                'create' => trans('Create'),
                'edit' => trans('Edit'),
                'update' => trans('Update'),
                'delete' => trans('Delete'),
                'select' => trans('Select'),
                'cancel' => trans('Cancel'),
                'previous' => trans('Anterior'),
                'next' => trans('Siguiente'),
                'search' => trans('Search'),
                'logout' => trans('Logout'),
                'are_you_sure_to_delete_the_record' => trans('Are you sure to delete the record?'),
                'are_you_sure_to_update_the_record' => trans('Are you sure to update the record?'),
                'this_action_cannot_be_reversed' => trans('This action cannot be reversed'),
                'there_is_one_error' => trans('There is One Error'),
                'there_are' => trans('There Are'),
                'errors' => trans('Errors'),
            ]
        ]);
        $this->registerLengthAwarePaginator();
    }

    /**
     * Resolve shared validation errors.
     *
     * @return \Illuminate\Contracts\Support\MessageBag|\stdClass
     */
    protected function sharedValidationErrors()
    {
        if ($errors = session('errors')) {
            return $errors->getBag('default');
        }

        return new \stdClass;
    }

    protected function registerLengthAwarePaginator()
    {
        $this->app->bind(LengthAwarePaginator::class, function ($app, $values) {
            return new class(...array_values($values)) extends LengthAwarePaginator {
                public function only(...$attributes)
                {
                    return $this->transform(function ($item) use ($attributes) {
                        return $item->only($attributes);
                    });
                }

                public function transform($callback)
                {
                    $this->items->transform($callback);

                    return $this;
                }

                public function toArray()
                {
                    return [
                        'data' => $this->items->toArray(),
                        'links' => $this->links(),
                    ];
                }

                public function links($view = null, $data = [])
                {
                    $this->appends(Request::all());

                    $window = UrlWindow::make($this);

                    $elements = array_filter([
                        $window['first'],
                        is_array($window['slider']) ? '...' : null,
                        $window['slider'],
                        is_array($window['last']) ? '...' : null,
                        $window['last'],
                    ]);

                    return Collection::make($elements)->flatMap(function ($item) {
                        if (is_array($item)) {
                            return Collection::make($item)->map(function ($url, $page) {
                                return [
                                    'url' => $url,
                                    'label' => $page,
                                    'active' => $this->currentPage() === $page,
                                ];
                            });
                        } else {
                            return [
                                [
                                    'url' => null,
                                    'label' => '...',
                                    'active' => false,
                                ],
                            ];
                        }
                    })->prepend([
                        'url' => $this->previousPageUrl(),
                        'label' => trans('Previous'),
                        'active' => false,
                    ])->push([
                        'url' => $this->nextPageUrl(),
                        'label' => trans('Next'),
                        'active' => false,
                    ]);
                }
            };
        });
    }
}
