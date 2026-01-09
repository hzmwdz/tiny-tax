<?php

namespace Hzmwdz\TinyTax;

use Illuminate\Support\ServiceProvider;

class TinyTaxServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $bindings = [
            Contracts\CalculateTax::class => Actions\CalculateTax::class,
            Contracts\CreateTax::class    => Actions\CreateTax::class,
            Contracts\DeleteTax::class    => Actions\DeleteTax::class,
            Contracts\GetTax::class       => Actions\GetTax::class,
            Contracts\GetTaxList::class   => Actions\GetTaxList::class,
            Contracts\UpdateTax::class    => Actions\UpdateTax::class,
        ];

        foreach ($bindings as $abstract => $concrete) {
            $this->app->bind($abstract, $concrete);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(dirname(__DIR__) . '/database/migrations');

        $this->loadTranslationsFrom(dirname(__DIR__) . '/resources/lang', 'tiny-tax');

        $this->publishes([
            dirname(__DIR__) . '/database/migrations' => $this->app->databasePath('migrations'),
        ], 'migrations');

        $this->publishes([
            dirname(__DIR__) . '/resources/lang' => $this->app->resourcePath('lang/vendor/tiny-tax'),
        ], 'translations');
    }
}
