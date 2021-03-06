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
Route::group(['prefix' => 'v1'], function () {

    //no auth
    Route::get('/test', 'Api\V1\TestController@test');

    //auth
    Route::middleware('auth:api')->group(function (){
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
    });

});

