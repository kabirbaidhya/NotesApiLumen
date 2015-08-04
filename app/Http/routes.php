<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

$app->group([
    'prefix' => 'api/v1',
    'namespace' => 'App\Http\Api\V1\Controllers'
], function ($app) {
    $app->get('notes', 'NoteController@index');
});
