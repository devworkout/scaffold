<?php

namespace DevWorkout\Scaffold;

use Afterflow\Framework\ScaffolderDiscovery;
use DevWorkout\Scaffold\Scaffolders\MultiScaffolder;
use Illuminate\Support\ServiceProvider;

class ScaffoldServiceProvider extends ServiceProvider implements ScaffolderDiscovery
{
    public static function scaffolders(): array
    {
        return [
            MultiScaffolder::class,
//            AddIdeaToGitignore::class,
//            AddGithubRepository::class,
//            AddEnvoy::class,
//            AddHelpersFile::class,
//            AddLocalRoutes::class,
//            MoveUserModel::class,
//            AddMustHavePackages::class,
//            ScaffoldFrontend::class,
//            ScaffoldSaaS::class,
//            AddDigitalOceanDroplet::class,
        ];
    }

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
//            $this->app->tag(MultiScaffolder::class, ['afterflow-scaffolder', 'devworkout/scaffold']);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
    }
}