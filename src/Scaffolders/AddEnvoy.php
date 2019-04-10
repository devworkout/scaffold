<?php

namespace DevWorkout\Scaffold\Scaffolders;

use Afterflow\Framework\Scaffolder;

class AddEnvoy extends Scaffolder
{
    protected $question = 'Add Laravel Envoy?';

    public function handle()
    {
        $which = `which envoy`;
        if (!$which) {
            $this->exec('composer global require laravel/envoy', 'Envoy binary not found, installing: ');
        }
        $this->copyStub(__DIR__.'/../../stubs/', 'Envoy.blade.php');
    }

}