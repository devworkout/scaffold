<?php

namespace DevWorkout\Scaffold\Scaffolders;

use Afterflow\Framework\Scaffolder;

class AddGithubRepository extends Scaffolder
{
    protected $question = 'Add github repository?';

    public function handle()
    {
        if (!file_exists('.git') && $this->command->confirm('Local git repository not found. Create?', true)) {
            $this->exec('git init');
        }

        $org = $this->command->confirm('Use organization?', false);
        $private = $this->command->confirm('Make repository private?', true);

        $username = $this->command->ask('GitHub username', trim(`git config --global user.name`));
        $password = $this->command->secret('GitHub password');
        $repo_name = $this->command->ask('Repository name', basename(getcwd()));

        $u = $org ? ('orgs/'.$username) : ('user');

        $ch = curl_init('https://api.github.com/'.$u.'/repos');

        curl_setopt($ch, CURLOPT_USERPWD, $username.":".$password);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Afterflow');
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
                'name' => $repo_name,
                'private' => $private
            ])
        );

        $json = curl_exec($ch);
        curl_close($ch);

        $j = json_decode($json, true);

        if (isset($j['html_url'])) {
            `git remote add origin git@github.com:$username/$repo_name.git`;
            $this->command->line('Repository created: '.$j['html_url']);
        } else {
            $this->command->error('Failed to create repository: '.PHP_EOL.$json);
        }


    }

}