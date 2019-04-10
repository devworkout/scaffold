<?php

namespace DevWorkout\Scaffold\Scaffolders;

use Afterflow\Framework\Scaffolder;

class AddDefaultUser extends Scaffolder
{
    protected $question = 'Add default user?';

    public function handle()
    {

        if (file_exists('database/UsersTableSeeder.php')) {
            $this->command->line('Users table seeder already exists');
            return;
        }

        $defaultUser = [
            'email' => 'librevlad@gmail.com',
            'name' => 'Vladislav Otchenashev',
            'password' => 'secret',
        ];

        $credentials = collect($this->config('default_user') ?? []);

        if ($credentials->count()) {
            $logins = $credentials->map(function ($cred) {
                return $cred['name']."\t".$cred['email']."\t".$cred['password'];
            });
            $logins[] = '<comment>[add new default user]</comment>';
            $chosen = $this->command->choice('Which user to use?', $logins->toArray(), 0);
        }

        if (!$credentials->count() || $chosen == '<comment>[add new default user]</comment>') {

            $defaultUser['name'] = $this->command->ask('Name', trim(`git config --global user.name`));
            $defaultUser['email'] = $this->command->ask('Email', trim(`git config --global user.email`));
            $defaultUser['password'] = $this->command->ask('Password', 'secret');

            if ($this->command->confirm('Remember credentials?', true)) {
                $credentials->add($defaultUser);
                $this->config('default_user', $credentials->toArray());
            }
        } else {
            $user = $credentials[$logins->search($chosen)];
            $defaultUser = $user;
        }

        $d = var_export($defaultUser, true);
        $d = str_replace("'".$defaultUser['password']."'", "bcrypt('".$defaultUser['password']."')", $d);

        $this->copyStub(__DIR__.'/../../stubs/', 'database/seeds/UsersTableSeeder.php');

        $file = file_get_contents('database/seeds/UsersTableSeeder.php');
        $file = preg_replace('~/\*>>\*/.*?/\*<<\*/~ims', $d, $file);
        file_put_contents('database/seeds/UsersTableSeeder.php', $file);

        $this->command->task('Updating database seeder... ', function () {
            $this->replaceInFile('database/seeds/DatabaseSeeder.php',
                '// $this->call(UsersTableSeeder::class);',
                '$this->call(UsersTableSeeder::class);');
        });


    }

}