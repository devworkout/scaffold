<?php

namespace DevWorkout\Scaffold\Scaffolders;

use Afterflow\Framework\Scaffolder;

class ScaffoldFrontend extends Scaffolder
{
    protected $question = 'Scaffold frontend?';

    public function handle()
    {
        \File::deleteDirectory('resources/sass');
        \File::deleteDirectory('resources/js');
        $this->copyStub(__DIR__.'/../../stubs', 'frontend/', './');

        $this->package->removeDevDependencies([
            'bootstrap',
            'lodash',
            'popper.js',
        ]);

        $this->exec(
            'npm install --save-dev tailwindcss@next laravel-mix-tailwind laravel-mix-purgecss tailwindcss-tables animate.css moment moment-timezone vee-validate',
            'Updating package.json: ');

        $this->exec(
            [
                'npm install',
                'node_modules/.bin/tailwind init',
                'npm run dev && npm run dev',
            ], 'Initializing frontend: ');

    }

}