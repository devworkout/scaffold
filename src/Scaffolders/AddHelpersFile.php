<?php

namespace DevWorkout\Scaffold\Scaffolders;

use Afterflow\Framework\Scaffolder;

class AddHelpersFile extends Scaffolder
{
    protected $question = 'Add app/helpers.php?';

    public function handle()
    {
        if (!file_exists('/app') || file_exists('app/helpers.php')) {
            return;
        }

        $this->command->task('Adding helpers file', function () {
            $this->copyStub(__DIR__.'/../../stubs', 'helpers.php', 'app/helpers.php');
        });

        $this->command->task('Configuring composer autoload', function () {
            $this->composer->addAutoloadFiles('app/helpers.php');
        });
    }

}