<?php

namespace Astrotomic\CitybikesTile;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class CitybikesTileServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                FetchCitybikesStationsCommand::class,
            ]);
        }

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/dashboard-citybikes-tile'),
        ], 'dashboard-citybikes-tile-views');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'dashboard-citybikes-tile');

        Livewire::component('citybikes-tile', CitybikesTileComponent::class);
    }
}
