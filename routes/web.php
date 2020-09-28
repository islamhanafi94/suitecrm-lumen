<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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


$router->get('/module/{module_name}', 'ModuleController@index');
$router->get('/module/{module_name}/{id}', 'ModuleController@show');
$router->post('/module/{module_name}', 'ModuleController@create');
$router->patch('/module/{module_name}/{id}','ModuleController@update');
$router->delete('/module/{module_name}/{id}','ModuleController@delete');

// $router->get('/auth','ModuleController@auth');
// $router->group([
//         'prefix' => 'module/{module_name}',
//         // 'middleware' => ''
//     ],
//     function() use ($router){
//         $router->get('', );
//         $router->get('/{id}',[
//             'as' => 'profile',
//             'middleware'=> 'test',
//             'uses'=>'ModuleController@show'
//             ]);

//         $router->post('', 'ModuleController@create');
//         $router->patch('/{id}','ModuleController@update');
//         $router->delete('/{id}','ModuleController@delete');
// });

