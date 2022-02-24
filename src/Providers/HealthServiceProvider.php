<?php

namespace Laravel\Health\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Health\Commands\ReadyCheckCommand;
use Laravel\Health\HealthManager;
use Laravel\Health\Commands\CheckHealthCommand;
use Laravel\Health\Commands\HealthCheckCommand;

class HealthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishConfig();

        $this->loadRoutesFromRootFile();

        $this->commands([
            CheckHealthCommand::class,
            HealthCheckCommand::class,
            ReadyCheckCommand::class
        ]);

        $this->app->bind('laravel-health-checker', function (){
            return new HealthManager();
        });
    }

    private function loadRoutesFromRootFile()
    {
        $this->loadRoutesFrom(__DIR__.'/../../routes/routes.php');
    }

    private function publishConfig()
    {
        $this->publishes([
            __DIR__.'/../../config/health-checker.php' => config_path('health-checker.php')
        ]);
    }
}
