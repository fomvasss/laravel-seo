<?php

namespace Fomvasss\Seo;

use Fomvasss\Seo;
use Illuminate\Support\ServiceProvider;
use Fomvasss\Seo\Commands\SeoCommand;

class SeoServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/seo.php' => config_path('seo.php'),
        ]);

        if (! class_exists('CreateSeoTable')) {
            $this->publishes([
                __DIR__.'/../database/migrations/create_seos_table.php.stub' => database_path('migrations/'.date('Y_m_d_His', time()).'_create_seos_table.php'),
            ], 'laravel-seo-migrations');
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/seo.php', 'seo');

        $this->app->singleton(Seo::class, function () {
            return new Seo();
        });
    }
}
