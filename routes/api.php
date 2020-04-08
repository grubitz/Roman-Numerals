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

Route::get('convert/{integer}', 'ConversionController@convert')->where('integer', '[0-9]+');
Route::get('often_converted', 'OftenConvertedController@list');
Route::get('recently_converted', 'RecentlyConvertedController@list');
