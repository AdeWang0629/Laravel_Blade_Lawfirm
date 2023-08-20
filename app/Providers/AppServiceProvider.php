<?php

namespace App\Providers;

use App\Models\LawsuitCase;
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
        view()->composer('*', function($view) {
            Paginator::useBootstrap();
            $view->with([
                'getlawsuitCases' => LawsuitCase::all()
            ]);
        });
    }
}
