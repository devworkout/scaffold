<?php

namespace DevWorkout\Scaffold\Scaffolders;

use Afterflow\Framework\Scaffolder;

class AddMustHavePackages extends Scaffolder
{
    protected $question = 'Install must have composer packages?';

    public function handle()
    {
        $require = collect([
            "barryvdh/laravel-cors",
            "laracasts/flash",
            "pyaesone17/active-state",
            "calebporzio/awesome-helpers",
            "nunomaduro/laravel-console-summary"
        ]);

        $requireDev = collect([
            "barryvdh/laravel-ide-helper",
            "doctrine/dbal",
        ]);

        if (!$this->composer->hasPackages($require)) {
            $this->exec('composer require '.$require->implode(' '));
        }

        if (!$this->composer->hasPackages($requireDev)) {
            $this->exec('composer require --dev '.$requireDev->implode(' '));
        }

        $this->exec([
            'php artisan -q ide-helper:gen',
            'php artisan -q ide-helper:eloquent',
            'php artisan -q ide-helper:met',
        ], 'Generating ide helper files: ');
    }

}