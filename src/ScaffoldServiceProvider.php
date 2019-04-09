<?php

namespace DevWorkout\Scaffold;

use Afterflow\Framework\Console\Commands\ScaffoldCommand;
use DevWorkout\Scaffold\Scaffolders\MultiScaffolder;
use Illuminate\Support\ServiceProvider;

class ScaffoldServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->app->tag(MultiScaffolder::class, ['afterflow-scaffolder', 'devworkout/scaffold']);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
    }
}