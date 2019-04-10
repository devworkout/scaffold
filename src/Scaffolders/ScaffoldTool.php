<?php

namespace DevWorkout\Scaffold\Scaffolders;

use Afterflow\Framework\Scaffolder;
use Illuminate\Support\Facades\File;

class ScaffoldTool extends Scaffolder
{
    protected $question = 'Scaffold SaaS resources?';

    public function handle()
    {
        $this->command->task('Running make:auth... ', function () {
            $this->exec('php artisan make:auth --force');
        });

        File::delete('routes/web.php');
        $this->command->task('Copying default routes... ', function () {
            $this->copyStub(__DIR__.'/../../stubs', 'routes/web.php');
        });

        $this->command->task('Installing templates... ', function () {
            File::deleteDirectory('resources/views');
            $this->copyStub(__DIR__.'/../../stubs', 'views', 'resources/views');
        });

        $this->command->task('Adjusting auth controllers... ', function () {
            $this->replaceInFiles([
                'app/Http/Controllers/Auth/RegisterController.php',
                'app/Http/Controllers/Auth/LoginController.php',
                'app/Http/Controllers/Auth/ResetPasswordController.php',
                'app/Http/Controllers/Auth/VerificationController.php',
            ], '/home', '/app');
        });

        $this->command->task('Installing app controllers... ', function () {

            @File::delete('app/Http/Controllers/HomeController.php');
            $this->copyStub(__DIR__.'/../../stubs', 'app/Http/Controllers/App');

        });


    }

}