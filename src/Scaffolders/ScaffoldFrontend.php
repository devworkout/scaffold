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

        $deps = collect([
            'tailwindcss@next',
            'laravel-mix-tailwind',
            'laravel-mix-purgecss',
            'tailwindcss-tables',
            'animate.css',
            'moment',
            'moment-timezone',
            'vee-validate',
        ]);

        if (!$this->package->hasPackages($deps)) {
            $this->exec('npm install '.$deps->implode(' ').' --save-dev ', 'Updating package.json: ');
        }

        $this->exec(
            [
                'npm install',
                'node_modules/.bin/tailwind init',
                'npm run dev && npm run dev',
            ], 'Initializing frontend: ');

    }

}