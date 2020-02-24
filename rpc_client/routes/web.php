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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/info', function () {
    phpinfo();
});

Route::get('/redis', function () {
    \App\Services\Redis::set('test','hello');
    dd(\App\Services\Redis::get('test'));
});

Route::get('/rpc/client', 'ClientController@client');