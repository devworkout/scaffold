<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

/*
|--------------------------------------------------------------------------
| Front Routes - Landing and front pages
|--------------------------------------------------------------------------
|
| Define the landing page / FAQ / Contacts / etc routes in this section.
| Static pages can also go here.
|
*/

Route::view('', 'pages.landing');


/*
|--------------------------------------------------------------------------
| App Routes - Dashboard Area
|--------------------------------------------------------------------------
|
| Define the user area routes here. SaaS dashboard.
|
*/

Route::group([
    'prefix' => 'app',
    'namespace' => 'App',
    'as' => 'app.',
], function () {

    Route::get('', 'DashboardController@index')->name('dashboard.index');

    Route::get('account-settings', 'AccountSettingsController@index')->name('account.index');
    Route::post('account-settings', 'AccountSettingsController@update')->name('account.update');

});

