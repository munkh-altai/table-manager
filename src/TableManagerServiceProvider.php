<?php

namespace TableManager;

use Illuminate\Support\ServiceProvider as ServiceProvider;


class TableManagerServiceProvider extends ServiceProvider
{


    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {


        // For publishing configuration file
        $this->publishes([
            __DIR__ . '/Config/table-manager.php' => config_path('table-manager.php'),
        ], 'tm-config');


    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        $this->mergeConfigFrom(__DIR__ . '/Config/table-manager.php', 'TableManager');

        $this->app->singleton('TableManager', function ($app) {
            return new TableManager(config('table-manager'));
        });

        $this->app->alias('TableManager', 'TableManager\TableManager');

    }
}