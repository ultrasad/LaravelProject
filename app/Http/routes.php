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

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/', 'EventsController@index');
    Route::get('/register', function () {
        return redirect('/');
    });

    Route::get('user/{user}', [
    	'middleware' => ['auth', 'roles'], // A 'roles' middleware must be specified
    	'uses' => 'UserController@index',
    	'roles' => ['administrator', 'manager'] // Only an administrator, or a manager can access this route
    ]);

    Route::get('twitter/login',array('as' => 'twitter.login','uses' => 'TwitterController@login'));
    Route::get('twitter/callback', array('as' => 'twitter.callback','uses' =>'TwitterController@callback'));
    Route::get('twitter/error', array('as' => 'twitter.error','uses' =>'TwitterController@error'));
    Route::get('twitter/logout', array('as' => 'twitter.logout','uses' =>'TwitterController@logout'));
    Route::get('twitter/tweet', array('as' => 'twitter.tweet','uses' =>'TwitterController@tweet'));

    Route::get('home', 'HomeController@index');
    Route::get('events/locations/{id}', 'EventsController@locations');
    Route::post('events/desc_upload', 'EventsController@desc_upload');
    Route::get('events/branch/{id}', 'EventsController@branch');
    Route::get('maps/locations', 'MapsController@locations');
    Route::get('brand/register', [
      'middleware' => ['auth', 'roles'],
      'uses' => 'BrandController@register',
      'roles' => ['administrator', 'manager', 'company manager']
    ]);
    Route::post('brand/add_branch', 'BrandController@add_branch');

    Route::get('/brand/{id}', array('as' => 'id', 'uses' => 'BrandController@index'))
    ->where('id', '[0-9]+');

    Route::get('/admin',[
      'middleware' => ['auth', 'roles'],
      'uses' => 'EventsController@admin',
      'roles' => ['administrator']
    ]);

    Route::get('events/_search/{keywords}', array('as' => 'keywords', 'uses' => 'EventsController@search'));

    Route::resource('articles', 'ArticlesController'); //RESTful Resource Controllers
    Route::resource('events', 'EventsController'); //RESTful Resource Controllers
    Route::resource('maps', 'MapsController'); //RESTful Resource Controllers
    Route::resource('brand', 'BrandController'); //RESTful Resource Controllers
});
