<?php

namespace DevWorkout\Scaffold\Scaffolders;

use Afterflow\Framework\Scaffolder;

class AddMustHavePackages extends Scaffolder
{
    protected $question = 'Install must have composer packages?';


    public function handle()
    {
        $this->exec([
            'composer require --dev barryvdh/laravel-ide-helper doctrine/dbal',
            'composer require barryvdh/laravel-cors laracasts/flash pyaesone17/active-state calebporzio/awesome-helpers',
            'php artisan -q ide-helper:gen',
            'php artisan -q ide-helper:eloquent',
            'php artisan -q ide-helper:met',
        ], 'Configuring composer: ');
    }

}