<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get(env('APP_DOMAIN'), function() {
	return redirect(env('APP_URL'));
});

Route::group(['middleware' => 'prevent-back-history'], function () {
	Route::domain(env('APP_URL'))->group(function () {	
		// Authentication Routes...

		Route::get('/', function () {
		    return view('welcome');
		});

		Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
		Route::post('login', 'Auth\LoginController@login');
		Route::post('logout', 'Auth\LoginController@logout')->name('logout');

		// Password Reset Routes...
		Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
		Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
		Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
		Route::post('password/reset', 'Auth\ResetPasswordController@reset');
	});
});

Route::group(['middleware' => ['auth','prevent-back-history']], function () {
	Route::get('/afterlogin' , function(){
			return redirect()->route('dashboard');
	});
	if(env('APP_ENV')=='development'){
        Route::domain('appd.'. env('APP_DOMAIN'))->group(function (){	
	        Route::get('/dashboard', 'BotController@index')->name('dashboard');
	        Route::post('/addbot', 'BotController@addBotDetails')->name('addBot');
	        Route::get('/delete/{id}', 'BotController@deleteBot');
	        Route::post('/update/{id}', 'BotController@updateBotDetails');
	        Route::get('/buildapi/{id}','BuildApiUrlController@apiUrl');
	        Route::post('/addGlobalVar','BotController@addGlobalVar')->name('addGlobalVar');
	        Route::post('/updatevar/{id}', 'BotController@updateVarDetails');
	        Route::get('/deletevar/{id}', 'BotController@deleteVar');
	        Route::post('/postmessage','ApiController@checkMessage')->name('message_to_user');
	    });
    }
    else{
    	Route::domain('app.'. env('APP_DOMAIN'))->group(function (){	
	        Route::get('/dashboard', 'BotController@index')->name('dashboard');
	        Route::post('/addbot', 'BotController@addBotDetails')->name('addBot');
	        Route::get('/delete/{id}', 'BotController@deleteBot');
	        Route::post('/update/{id}', 'BotController@updateBotDetails');
	        Route::get('/buildapi/{id}','BuildApiUrlController@apiUrl');
	        Route::post('/addGlobalVar','BotController@addGlobalVar')->name('addGlobalVar');
	        Route::post('/updatevar/{id}', 'BotController@updateVarDetails');
	        Route::get('/deletevar/{id}', 'BotController@deleteVar');
	        Route::post('/postmessage','ApiController@checkMessage')->name('message_to_user');
	    });
    }
});

