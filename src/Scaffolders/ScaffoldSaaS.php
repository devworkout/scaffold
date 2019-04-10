<?php

namespace DevWorkout\Scaffold\Scaffolders;

use Afterflow\Framework\Scaffolder;

class ScaffoldSaaS extends Scaffolder
{
    protected $question = 'Scaffold SaaS resources?';

    public function handle()
    {
        $this->exec('php artisan make:auth --force');

        \File::deleteDirectory('resources/views');
        $this->copyStub(__DIR__.'/../../stubs', 'blade', 'resources/views');

        $web = file_get_contents('routes/web.php');

        if (preg_match('~view\(\s*?[\'\"]*?welcome[\'\"]*?\s*?\)~is', $web, $mtchs)) {
            $web = str_replace($mtchs[0], "view('pages.landing')", $web);
            file_put_contents('routes/web.php', $web);
        }

    }

}