<?php

namespace DevWorkout\Scaffold\Scaffolders;

use Afterflow\Framework\Scaffolder;

class AddLocalRoutes extends Scaffolder
{
    protected $question = 'Add local routes?';

    public function handle()
    {
        $this->copyStub(__DIR__.'/../../stubs', 'routes/local.php');
        $r = file_get_contents('app/Providers/RouteServiceProvider.php');

        if (strpos($r, 'local.php')) {
            return;
        }

        $r = str_replace('$this->mapWebRoutes();',
            '$this->mapWebRoutes();'.PHP_EOL.PHP_EOL.' if ( app()->environment() == \'local\' ) { Route::middleware( \'web\' )->namespace( $this->namespace )->group( base_path( \'routes/local.php\' ) ); } ',
            $r);

        file_put_contents('app/Providers/RouteServiceProvider.php', $r);

    }

}