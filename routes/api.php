<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
  'prefix'    => 'v1',
  'namespace' => 'API'
], function() {

  Route::post('/posts/create', [
    'as'    => 'posts.create',
    'uses'  => 'PostController@create'
  ]);

  Route::get('/post/{id}', [
    'as'    => 'posts.fetch',
    'uses'  => 'PostController@fetch'
  ]);

  Route::get('/posts', [
    'as'    => 'posts.fetchAll',
    'uses'  => 'PostController@fetchAll'
  ]);

  Route::put('/posts/{id}', [
    'as'    => 'posts.update',
    'uses'  => 'PostController@update'
  ]);

  Route::delete('/posts/{id}', [
    'as'    => 'posts.delete',
    'uses'  => 'PostController@delete'
  ]);

  Route::post('/comments/create', [
    'as'    => 'comments.create',
    'uses'  => 'CommentController@create'
  ]);

  Route::delete('/comments/{id}', [
    'as'    => 'comments.delete',
    'uses'  => 'CommentController@delete'
  ]);

});
