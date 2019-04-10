<?php

namespace DevWorkout\Scaffold\Scaffolders;

use Afterflow\Framework\Concerns\RunsScaffolders;
use Afterflow\Framework\Scaffolder;
use DigitalOceanV2\Adapter\GuzzleHttpAdapter;
use DigitalOceanV2\DigitalOceanV2;

class AddDigitalOceanDroplet extends Scaffolder
{
    use RunsScaffolders;
    protected $question = 'Add DigitalOcean Droplet?';

    public function handle()
    {
        $token = null;

        $token = $this->config('digitalocean_token');
        if ($token) {
            $token = $this->command->confirm('Token found. Use it?', true) ? $token : null;
        }

        if (!$token) {
            $token = $this->command->secret('Enter DigitalOcean API token: ');
            if ($this->command->confirm('Remember this token?', true)) {
                $this->config('digitalocean_token', $token);
            }
        }

        $digitalocean = new DigitalOceanV2(new GuzzleHttpAdapter($token));

        $ip = false;

        $this->command->task('Adding droplet', function () use (&$ip, $digitalocean) {
            $droplet = $digitalocean->droplet()->create(
                $this->command->ask('droplet name', basename(getcwd())),
                'lon1',
                '512mb',
                'ubuntu-18-10-x64',
                false, // backups
                false, // ipv6
                true, // monitoring
                [
                    'ea:1c:f7:91:ee:af:7f:06:e8:e5:6d:f9:c1:59:44:4c', // exfriend
                    '85:a4:b7:b9:8b:f9:73:84:4f:77:a6:f3:15:a1:bb:da', // librevlad
                ],
                file_get_contents(__DIR__.'/../../userdata.sh')
            );
            $ip = (string) $digitalocean->droplet()->waitForActive($droplet, 10000)->networks[0]->ipAddress;
        });

        $this->command->line('IP: '.$ip);
        if ($this->command->confirm('Add this droplet to Envoy config?', true)) {
            if (!file_exists('Envoy.blade.php')) {
                if ($this->command->confirm('Envoy configuration not found. Scaffold Envoy now?', true)) {
                    $this->runScaffolder(AddEnvoy::class);
                }
            }

            $this->command->task('Updating Envoy file', function () use ($ip) {
                $this->replaceInFile('Envoy.blade.php', 'root@nasa.gov', 'root@'.$ip);
            });
        }


    }

}