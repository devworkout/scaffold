<?php

namespace DevWorkout\Scaffold\Scaffolders;

use Afterflow\Framework\Concerns\RunsScaffolders;
use Afterflow\Framework\Scaffolder;

class ToolScaffolder extends Scaffolder
{
    use RunsScaffolders;

    static $description = 'Scaffold a tool application';

    function handle()
    {
        $scaffolders = [
            AddIdeaToGitignore::class,
            AddGithubRepository::class,
            AddEnvoy::class,
            \DevWorkout\ScaffoldDocker\Scaffolders\ScaffoldDocker::class,
            AddHelpersFile::class,
            AddLocalRoutes::class,
            AddWebhookRoutes::class,
            MoveUserModel::class,
            AddMustHavePackages::class,
            ScaffoldFrontend::class,
            ScaffoldTool::class,
            AddDigitalOceanDroplet::class,
        ];

        $this->runScaffolders($scaffolders);


    }
}