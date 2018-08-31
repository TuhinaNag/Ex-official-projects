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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
if(env('APP_ENV')=='development'){
    Route::domain('apid.'. env('APP_DOMAIN'))->group(function (){
	    Route::post('v1/auth/registration', ['uses'=>'UserController@postSignup']);
		Route::any('v1/bot/{botId}/token/{broadcastAPItoken}/clear-attribute', ['uses'=>'ApiController@clearAttribute']);
		Route::any('v1/bot/{botId}/token/{broadcastAPItoken}/today/day', ['uses'=>'ApiController@showDay']);
		Route::any('v1/bot/{botId}/token/{broadcastAPItoken}/today/date', ['uses'=>'ApiController@showDate']);
		Route::any('v1/bot/{botId}/token/{broadcastAPItoken}/today/time', ['uses'=>'ApiController@showTime']);
		Route::any('v1/bot/{botId}/token/{broadcastAPItoken}/setglobalvariable', ['uses'=>'ApiController@setglobalvariable']);
		Route::any('v1/bot/{botId}/token/{broadcastAPItoken}/getglobalvariable', ['uses'=>'ApiController@getglobalvariable']);
		Route::any('v1/bot/{botId}/token/{broadcastAPItoken}/resetglobalvariable', ['uses'=>'ApiController@resetglobalvariable']);
		Route::any('v1/bot/{botId}/token/{broadcastAPItoken}/incrementglobalvariable', ['uses'=>'ApiController@incrementglobalvariable']);
		Route::any('v1/bot/{botId}/token/{broadcastAPItoken}/decrementglobalvariable', ['uses'=>'ApiController@decrementglobalvariable']);
	});
} else {
	Route::domain('api.' . env('APP_DOMAIN'))->group(function (){
		Route::post('v1/auth/registration', ['uses'=>'UserController@postSignup']);
		Route::any('v1/bot/{botId}/token/{broadcastAPItoken}/clear-attribute', ['uses'=>'ApiController@clearAttribute']);
		Route::any('v1/bot/{botId}/token/{broadcastAPItoken}/today/day', ['uses'=>'ApiController@showDay']);
		Route::any('v1/bot/{botId}/token/{broadcastAPItoken}/today/date', ['uses'=>'ApiController@showDate']);
		Route::any('v1/bot/{botId}/token/{broadcastAPItoken}/today/time', ['uses'=>'ApiController@showTime']);
		Route::any('v1/bot/{botId}/token/{broadcastAPItoken}/setglobalvariable', ['uses'=>'ApiController@setglobalvariable']);
		Route::any('v1/bot/{botId}/token/{broadcastAPItoken}/getglobalvariable', ['uses'=>'ApiController@getglobalvariable']);
		Route::any('v1/bot/{botId}/token/{broadcastAPItoken}/resetglobalvariable', ['uses'=>'ApiController@resetglobalvariable']);
		Route::any('v1/bot/{botId}/token/{broadcastAPItoken}/incrementglobalvariable', ['uses'=>'ApiController@incrementglobalvariable']);
		Route::any('v1/bot/{botId}/token/{broadcastAPItoken}/decrementglobalvariable', ['uses'=>'ApiController@decrementglobalvariable']);
		//Route::any('v1/campaign/{campaign_id?}',['uses'=>'ApiController@sentCampaignData']);
	});
}