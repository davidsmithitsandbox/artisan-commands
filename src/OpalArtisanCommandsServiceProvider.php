<?php

namespace Opal\ArtisanCommands;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class OpalArtisanCommandsServiceProvider extends ServiceProvider implements DeferrableProvider
{

    /**
     * Register the package services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->commands(
                [
                    MakeDir::class,
                    DeleteDir::class,
                ]
            );
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            MakeDir::class,
            DeleteDir::class,
        ];
    }
}
