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

$router->group(['prefix' => 'api/v1'], function () use ($router) {
    // Author Routes
    $router->get('authors',            ['uses' => 'AuthorController@index',   'as' => 'author.index']);
    $router->get('authors/{author}',   ['uses' => 'AuthorController@show',    'as' => 'author.show']);
    $router->post('authors',           ['uses' => 'AuthorController@store',   'as' => 'author.store']);
    $router->put('authors/{id}',       ['uses' => 'AuthorController@update',  'as' => 'author.update']);
    $router->delete('authors/{id}',    ['uses' => 'AuthorController@destroy',  'as' => 'author.destroy']);
});
