<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return $app->version();
});


$app->get('/accounts', 'AccountController@all');

$app->get('/accounts/{account_id}', 'AccountController@one');
$app->get('/accounts/data/{account_id}_pdf', 'AccountController@pdf');

$app->put('/accounts/{account_id}', 'AccountController@update');
