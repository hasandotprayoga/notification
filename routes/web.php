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

$router->get('/', function () use ($router) {
    return env('APP_NAME');
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->group(['prefix' => 'v1'], function () use ($router) {
        $router->group(['prefix' => 'pusher'], function () use ($router) {
        	
        	$router->group(['prefix' => 'channel'], function () use ($router) {
		        $router->post('/push', 'PusherController@channel');
		    });

		    $router->group(['prefix' => 'beams'], function () use ($router) {
		        $router->post('/interests', 'PusherController@interests');
		        $router->post('/users', 'PusherController@users');
		        $router->get('/generate-token', 'PusherController@generateToken');
		        $router->delete('/delete-user', 'PusherController@deleteUser');
		    });
	    });

	    $router->group(['prefix' => 'onesignal'], function () use ($router) {
	        $router->post('/all', 'OneSignalController@all');
	        $router->post('/users', 'OneSignalController@users');
	        $router->post('/tags', 'OneSignalController@tags');
	        $router->post('/segments', 'OneSignalController@segments');
	        $router->delete('/cancel', 'OneSignalController@cancel');
	    });
    });
});