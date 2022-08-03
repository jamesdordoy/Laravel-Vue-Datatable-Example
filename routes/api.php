<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/eloquent', [
    'uses' => 'UserController@index',
]);

Route::get('/eloquent/search', [
    'uses' => 'UserController@search',
]);

Route::get('/query-builder', [
    'uses' => 'UserController@queryBuilder',
]);

