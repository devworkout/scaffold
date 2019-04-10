<?php

namespace DevWorkout\Scaffold\Scaffolders;

use Afterflow\Framework\Scaffolder;

class AddLocalRoutes extends Scaffolder
{
    protected $question = 'Add local routes?';

    public function handle()
    {
        $this->copyStub(__DIR__.'/../../stubs', 'routes/local.php');

        $this->replaceInFileIfNotAlready('app/Providers/RouteServiceProvider.php', '$this->mapWebRoutes();',
            '$this->mapWebRoutes();'.PHP_EOL.PHP_EOL.' if ( app()->environment() == \'local\' ) { Route::middleware( \'web\' )->namespace( $this->namespace )->group( base_path( \'routes/local.php\' ) ); } ',
            'local.php'
        );

    }

}