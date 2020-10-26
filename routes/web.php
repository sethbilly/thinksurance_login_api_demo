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

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('register', ['as' => 'api.register', 'uses' => 'LoginController@register']);
    $router->post('login', ['as' => 'api.login', 'uses' => 'LoginController@authenticate']);
    $router->post('roles/assign', ['as' => 'api.roles.assign', 'uses' => 'RoleController@rolesAddUser']);
});
