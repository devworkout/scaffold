<?php

namespace DevWorkout\Scaffold\Scaffolders;

use Afterflow\Framework\Scaffolder;

class MoveUserModel extends Scaffolder
{
    protected $question = 'Move User to app/Models?';

    public function handle()
    {
        if (!file_exists('app/User.php') || file_exists('app/Models/User.php')) {
            return;
        }

        $this->command->task('Moving model... ', function () {
            $user = file_get_contents('app/User.php');
            $user = str_replace('namespace App;', 'namespace App\Models;', $user);
            $user = preg_replace('~fillable.*?\[.*?];~ims', 'guarded = [];', $user);
            @mkdir('app/Models');
            file_put_contents('app/Models/User.php', $user);
            unlink('app/User.php');
        });

        $this->command->task('Updating other places... ', function () {
            $this->replaceInFiles([
                'config/auth.php',
                'app/Http/Controllers/Auth/RegisterController.php',
                'database/factories/UserFactory.php',
                'database/seeds/UsersTableSeeder.php',
            ], 'App\User', 'App\Models\User');
        });


    }

}