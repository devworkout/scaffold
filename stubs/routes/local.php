<?php

/*
|--------------------------------------------------------------------------
| Local Routes
|--------------------------------------------------------------------------
|
| Here is where you can register local routes. These routes only work in
| a "local" environment.
|
*/

Route::get('test', function (Request $request) {
    return 'I am only visible in non-production environment';
});
