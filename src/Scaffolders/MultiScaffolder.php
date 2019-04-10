<?php

namespace DevWorkout\Scaffold\Scaffolders;

use Afterflow\Framework\Concerns\RunsScaffolders;
use Afterflow\Framework\Scaffolder;

class MultiScaffolder extends Scaffolder
{
    use RunsScaffolders;

    function handle()
    {
        $scaffolders = [
            AddIdeaToGitignore::class,
            AddGithubRepository::class,
            AddEnvoy::class,
            \DevWorkout\ScaffoldDocker\Scaffolders\ScaffoldDocker::class,
            AddHelpersFile::class,
            AddLocalRoutes::class,
            MoveUserModel::class,
            AddMustHavePackages::class,
            ScaffoldBlade::class,
            ScaffoldFrontend::class,
            AddDigitalOceanDroplet::class,
        ];

        $this->runScaffolders($scaffolders);


    }
}