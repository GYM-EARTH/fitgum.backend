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

Route::get('/categories', 'Api\\CategoriesController@index');

Route::get('/categories/{slug}', 'Api\\CategoriesController@show');

Route::get('/news', 'Api\\NewsController@index');

Route::get('/news/{slug}', 'Api\\NewsController@show');

Route::get('/types', 'Api\\TypesController@index');

Route::get('/types/{slug}', 'Api\\TypesController@show');

Route::get('/clubs', 'Api\\ClubsController@index');

Route::get('/clubs/{slug}', 'Api\\ClubsController@show');

Route::get('/trainers', 'Api\\TrainersController@index');

Route::get('/trainers/{slug}', 'Api\\TrainersController@show');

Route::get('/videos', 'Api\\VideosController@index');

Route::get('/videos/{slug}', 'Api\\VideosController@show');

Route::get('/flaers', 'Api\\FlaersController@index');

Route::get('/flaers/{slug}', 'Api\\FlaersController@show');
