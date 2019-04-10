<?php

namespace DevWorkout\Scaffold\Scaffolders;

use Afterflow\Framework\Scaffolder;

class AddIdeaToGitignore extends Scaffolder
{
    protected $question = 'Add .idea to .gitignore?';

    public function handle()
    {
        file_put_contents('.gitignore', collect(file('.gitignore'))->map(function ($v) {
            return trim($v);
        })->add('.idea')->unique()->implode(PHP_EOL));
    }

}