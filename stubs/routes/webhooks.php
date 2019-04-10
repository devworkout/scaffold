<?php

/*
|--------------------------------------------------------------------------
| Webhook Routes
|--------------------------------------------------------------------------
|
| Here is where you can register webhook routes. These routes are meant to
| handle webhooks from 3rd-party applications - social login, payment processor,
| slack, etc. Keep your main routes file clean.
|
*/

Route::get('test', function (Request $request) {
    return 'Endpoint /webhooks/test works!';
});