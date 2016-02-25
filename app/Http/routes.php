<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
  Route::get('hello', 'HelloController@index');
  Route::resource('articles', 'ArticlesController'); //RESTful Resource Controllers
});

//Route::get('hello', 'HelloController@index');
//Route::resource('articles', 'ArticlesController'); //RESTful Resource Controllers

/*
Route::get('/articles/create', 'ArticlesController@create');
Route::post('/articles', 'ArticlesController@store');
Route::get('/articles/{id}', 'ArticlesController@show');

Route::get('/articles/{id}/edit', 'ArticlesController@edit');
Route::put('/articles/{id}', 'ArticlesController@update');

Route::delete('/articles/{id}', 'ArticlesController@distroy');
//Route::resource('auth', 'Auth\AuthController');
*/
