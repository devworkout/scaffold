<?php

namespace DevWorkout\Scaffold\Scaffolders;

use Afterflow\Framework\Scaffolder;
use Github\Client;
use Github\Exception\RuntimeException;

class AddGithubRepository extends Scaffolder
{
    protected $question = 'Add github repository?';

    protected $github;

    public function handle()
    {
        if (!file_exists('.git') && $this->command->confirm('Local git repository not found. Create?', true)) {
            $this->exec('git init');
        }

        $credentials = collect($this->config('github_credentials') ?? []);

        if ($credentials->count()) {

            $logins = $credentials->pluck('username')->toArray();
            $logins[] = '<comment>[add new login]</comment>';
            $chosen = $this->command->choice('Which username to use?', $logins, 0);

        }

        if (!$credentials->count() || $chosen == '<comment>[add new login]</comment>') {

            $username = $this->command->ask('GitHub username', trim(`git config --global user.name`));
            $password = $this->command->secret('GitHub password');

            if ($this->command->confirm('Remember credentials?', true)) {
                $credentials->add([
                    'username' => $username,
                    'password' => $password,
                ]);

                $this->config('github_credentials', $credentials->toArray());
            }
        } else {
            $user = $credentials->firstWhere('username', $chosen);
            $username = $user['username'];
            $password = $user['password'];
        }

        $this->github = new Client();
        $this->github->authenticate($username, $password, Client::AUTH_HTTP_PASSWORD);

        $repo_name = $this->command->ask('Repository name', basename(getcwd()));

        try {
            while ($this->repositoryExists($repo_name)) {
                $repo_name = $this->command->ask('Repository <comment>'.$repo_name.'</comment> exists. Pick another name: ',
                    basename(getcwd()));
            }

            $private = $this->command->confirm('Make repository private?', true);

            $j = $this->github->repos()->create($repo_name, '', '', !$private);

            if (!isset($j['html_url'])) {
                $this->command->error('Failed to create repository: '.PHP_EOL.print_r($j, true));
                return $this->restart();
            }

        } catch (RuntimeException $e) {
            $this->command->error('ERROR: '.$e->getMessage());
            return $this->restart();
        }

        $this->exec('git remote add origin '.$j['git_url']);
        $this->command->line('Repository created: '.$j['html_url']);

    }

    protected function repositoryExists($repo_name)
    {
        return collect($this->github->currentUser()->repositories())->pluck('name')->contains($repo_name);
    }

}