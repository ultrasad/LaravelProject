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

//Route::get('/images/events/2016-05-23/{$path}}', function(League\Glide\Server $server, $path){
  //echo 'xx path => ';
  //dd($path);
//});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/', 'EventsController@index');
    Route::get('/register', function () {
        return redirect('/');
    });

    Route::get('/clear-cache', function() {
        $clearCompiled = Artisan::call('clear-compiled');
        $clearView = Artisan::call('view:clear');
        $clearCache = Artisan::call('cache:clear');
        //$clearRoute = Artisan::call('route:cache');
        // return what you want
    });

    Route::get('/reindex', 'EventsController@reindex');

    //Route::get('/reindex', function() {
      //$reIndex = Artisan::call('larasearch:reindex', ['--relations App\Event']);
    //});

    /*Route::get('/posttweet', function()
    {
        return Twitter::postTweet(['status' => 'Laravel is beautiful', 'format' => 'json']);
    });*/

    Route::get('/events/post_social/{event_id}', 'EventsController@post_social');

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
    //Route::get('events/branch/{id}', 'EventsController@branch');
    Route::get('events/brand/{id}', 'EventsController@brand');
    Route::get('events/removefile/{id}/{image}', 'EventsController@removefile');

    Route::get('tag/{name}', 'TagsController@index');
    Route::get('category/{name}', 'CategoryController@index');
    Route::get('brand/category/{name}', 'BrandController@category');
    Route::get('brand/locations/{slug}', 'BrandController@locations');
    Route::get('maps/locations', 'MapsController@locations');
    Route::get('map', 'MapsController@index');
    //Route::get('map/check', 'MapsController@check');
    //Route::get('events/check', 'EventsController@check');
    Route::get('map/locations/{id}', 'MapsController@locations');
    Route::get('map/latlon/{lat}/{lon}', 'MapsController@latlon');
    //Route::get('map/{lat}/{lon}', 'MapsController@index')->where(['lat' => '[0-9\.]+', 'lon' => '[0-9\.]+']);
    Route::get('map/{lat}/{lon}', 'MapsController@index')->where(['lat' => '[0-9\.]+', 'lon' => '[0-9\.]+']);
    //Route::get('maps/{id}', 'MapsController@index'); //old solution
    Route::get('brand/register', [
      'middleware' => ['auth', 'roles'],
      'uses' => 'BrandController@register',
      'roles' => ['administrator', 'manager']
    ]);
    Route::post('brand/add_branch', 'BrandController@add_branch');

    Route::get('brand/lists', 'BrandController@lists');

    Route::get('/brand/{id}', array('as' => 'id', 'uses' => 'BrandController@index'))
    ->where('id', '[0-9]+');

    Route::get('/brand/{slug}', array('as' => 'slug', 'uses' => 'BrandController@index'))
    ->where('slug', '[A-Za-z0-9\-]+');

    Route::get('/admin',[
      'middleware' => ['auth', 'roles'],
      //'uses' => 'EventsController@admin',
      'uses' => 'AdminController@index',
      'roles' => ['Administrator', 'Manager', 'Company Manager']
    ]);

    Route::get('/admin/setting',[
      'middleware' => ['auth', 'roles'],
      //'uses' => 'EventsController@admin',
      'uses' => 'AdminController@setting',
      'roles' => ['Administrator', 'Manager']
    ]);

    Route::resource('brand', 'BrandController'); //RESTful Resource Controllers
    Route::resource('contact', 'ContactController'); //RESTful Resource Controllers
    Route::resource('events', 'EventsController'); //RESTful Resource Controllers

    //filter
    Route::get('/{filter}', array('as' => 'filter', 'uses' => 'FilterController@condition'))
    ->where('filter', '(today|thisweek|[0-9]{4}-[0-9]{2}-[0-9]{2})');

    //Route::get('events/search/{keywords}', array('as' => 'keywords', 'uses' => 'EventsController@search'));
    Route::get('events/search/{type}/{keywords}', 'EventsController@search');
    Route::get('/{slug}', array('as' => 'slug', 'uses' => 'EventsController@show'));

    //Route::resource('articles', 'ArticlesController'); //RESTful Resource Controllers
    //Route::resource('events', 'EventsController'); //RESTful Resource Controllers
    //Route::resource('maps', 'MapsController'); //RESTful Resource Controllers
    //Route::resource('brand', 'BrandController'); //RESTful Resource Controllers
    //Route::resource('contact', 'ContactController'); //RESTful Resource Controllers
});
