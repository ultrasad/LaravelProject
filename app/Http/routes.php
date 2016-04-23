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
Route::get('/', function () {
    return view('welcome');
});
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

/*
Route::group(['middleware' => ['web']], function () {
  //Route::get('hello', 'HelloController@index');
  Route::resource('articles', 'ArticlesController'); //RESTful Resource Controllers
});
*/

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

//Route::resource('/articles', 'ArticlesController'); //RESTful Resource Controllers
//Route::post('/events/post_upload', 'EventsController@post_upload');
//Route::post('events/desc_upload', 'EventsController@desc_upload');
//Route::post('brand/branch', 'BrandController@branch');

Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/', function () {
        return view('welcome');
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

    /*
    Route::get('/twitter', function()
    {
        return Twitter::getUserTimeline(['screen_name' => 'thujohn', 'count' => 1, 'format' => 'json']);
    });

    Route::get('/twitter/post', function()
    {
        return Twitter::postTweet(['status' => 'Laravel is beautiful', 'format' => 'json']);
    });

    Route::get('twitter/login', ['as' => 'twitter.login', function(){
        // your SIGN IN WITH TWITTER  button should point to this route
        $sign_in_twitter = true;
        $force_login = false;

        // Make sure we make this request w/o tokens, overwrite the default values in case of login.
        Twitter::reconfig(['token' => '', 'secret' => '']);
        $token = Twitter::getRequestToken(route('twitter.callback'));

        if (isset($token['oauth_token_secret']))
        {
            $url = Twitter::getAuthorizeURL($token, $sign_in_twitter, $force_login);

            Session::put('oauth_state', 'start');
            Session::put('oauth_request_token', $token['oauth_token']);
            Session::put('oauth_request_token_secret', $token['oauth_token_secret']);

            return Redirect::to($url);
        }

        return Redirect::route('twitter.error');
    }]);

    //Route::get('twitter/callback', ['as' => 'twitter.callback', function() {
    Route::get('twitter/callback', ['as' => 'twitter.callback', function() {
        // You should set this route on your Twitter Application settings as the callback
        // https://apps.twitter.com/app/YOUR-APP-ID/settings
        if (Session::has('oauth_request_token'))
        {
            $request_token = [
                'token'  => Session::get('oauth_request_token'),
                'secret' => Session::get('oauth_request_token_secret'),
            ];

            Twitter::reconfig($request_token);

            $oauth_verifier = false;

            if (Input::has('oauth_verifier'))
            {
                $oauth_verifier = Input::get('oauth_verifier');
            }

            // getAccessToken() will reset the token for you
            $token = Twitter::getAccessToken($oauth_verifier);

            if (!isset($token['oauth_token_secret']))
            {
                return Redirect::route('twitter.login')->with('flash_error', 'We could not log you in on Twitter.');
            }

            $credentials = Twitter::getCredentials();

            if (is_object($credentials) && !isset($credentials->error))
            {
                // $credentials contains the Twitter user object with all the info about the user.
                // Add here your own user logic, store profiles, create new users on your tables...you name it!
                // Typically you'll want to store at least, user id, name and access tokens
                // if you want to be able to call the API on behalf of your users.

                // This is also the moment to log in your users if you're using Laravel's Auth class
                // Auth::login($user) should do the trick.

                Session::put('access_token', $token);

                return Redirect::to('/')->with('flash_notice', 'Congrats! You\'ve successfully signed in!');
            }

            return Redirect::route('twitter.error')->with('flash_error', 'Crab! Something went wrong while signing you up!');
        }
    }]);

    Route::get('twitter/error', ['as' => 'twitter.error', function(){
        // Something went wrong, add your own error handling here
    }]);

    Route::get('twitter/logout', ['as' => 'twitter.logout', function(){
        Session::forget('access_token');
        return Redirect::to('/')->with('flash_notice', 'You\'ve successfully logged out!');
    }]);
    */

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
    //Route::get('brand/(:number)', 'BrandController@index');
    //Route::get('/brand/{id}', array('as' => 'brand', function(){
        //return App::make('BrandController')->index(1);
    //}));

    //Route::get('{product}', array('as' => 'product', 'uses' => 'ProductsController@index'))
    //->where('product', '(milk|cheese)');
    Route::get('/brand/{id}', array('as' => 'id', 'uses' => 'BrandController@index'))
    ->where('id', '[0-9]+');
    //Route::get('brand/{id}', function($id){
    //})->where('id', '[0-9]+');
    Route::resource('articles', 'ArticlesController'); //RESTful Resource Controllers
    Route::resource('events', 'EventsController'); //RESTful Resource Controllers
    Route::resource('maps', 'MapsController'); //RESTful Resource Controllers
    Route::resource('brand', 'BrandController'); //RESTful Resource Controllers
});
