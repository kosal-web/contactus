<?php

namespace Din\ContactUs;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class ContactUsServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'din');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'din');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');
        // $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        
        $this->registerRoutes();
        
        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/contactus.php', 'contactus');

        // Register the service the package provides.
        $this->app->singleton('contactus', function ($app) {
            return new ContactUs;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['contactus'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/contactus.php' => config_path('contactus.php'),
        ], 'contactus.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/din'),
        ], 'contactus.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/din'),
        ], 'contactus.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/din'),
        ], 'contactus.views');*/

        // Registering package commands.
        // $this->commands([]);
    }

    protected function routeConfiguration()
    {
        return [
            'prefix' => config('contactus.prefix'),
            'middleware' => config('contactus.middleware'),
        ];
    }

    protected function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });
    }
}
