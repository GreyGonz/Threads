<?php

namespace Greygonz\Threads\Providers;

use Illuminate\Support\ServiceProvider;

class ThreadsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
      $this->loadRoutesFrom(__DIR__.'/../routes/routes.php');
      $this->loadViewsFrom(__DIR__.'/../views', 'threads');
      $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
      $this->app->make('Greygonz\Threads\Controllers\ApiThreadsController');
      $this->app->make('Greygonz\Threads\Controllers\ThreadsController');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
//        $this->loadRoutesFrom('../routes/routes.php');
//        $this->loadViewsFrom(__DIR__.'/../views', 'threads');
//        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
//        $this->app->make('Greygonz\Threads\Controllers\ApiThreadsController');
//        $this->app->make('Greygonz\Threads\Controllers\ThreadsController');
    }
}
