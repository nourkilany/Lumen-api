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

    // Article Routes
    $router->get('articles',           ['uses' => 'ArticleController@index',   'as' => 'article.index']);
    $router->get('articles/{article}', ['uses' => 'ArticleController@show',    'as' => 'article.show']);
    $router->post('articles',          ['uses' => 'ArticleController@store',   'as' => 'article.store']);
    $router->put('articles/{id}',      ['uses' => 'ArticleController@update',  'as' => 'article.update']);
    $router->delete('articles/{id}',   ['uses' => 'ArticleController@destroy', 'as' => 'article.destroy']);
});
