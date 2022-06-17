<?php

namespace Fomvasss\Seo;

use Illuminate\Support\ServiceProvider;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Fomvasss\Seo\Commands\SeoCommand;

class SeoServiceProvider extends ServiceProvider //extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-seo')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_seos_table')
            ->hasCommand(SeoCommand::class);
    }

    public function register()
    {
        //$this->mergeConfigFrom(__DIR__.'/../config/seo.php', 'seo');

        $this->app->singleton(Seo::class);
    }
}
