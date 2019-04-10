<?php

namespace DevWorkout\Scaffold\Scaffolders;

use Afterflow\Framework\Scaffolder;

class AddWebhookRoutes extends Scaffolder
{
    protected $question = 'Add routes file for webhooks?';

    public function handle()
    {
        $this->copyStub(__DIR__.'/../../stubs', 'routes/webhooks.php');

        $this->replaceInFileIfNotAlready('app/Providers/RouteServiceProvider.php', '$this->mapWebRoutes();',
            '$this->mapWebRoutes();'.PHP_EOL.PHP_EOL.' Route::middleware( \'web\' )->namespace( $this->namespace )->prefix(\'webhooks\')->group( base_path( \'routes/webhooks.php\' ) ); ',
            'webhooks.php'
        );

    }

}