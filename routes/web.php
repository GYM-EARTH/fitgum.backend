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
/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/get-token', function () {
    /** @var \App\Models\User $user */
    $user = \Illuminate\Support\Facades\Auth::user();
    $token = $user->createToken($user->name)->accessToken;
    return response($token);
})->middleware('auth');



Route::get('/home', 'HomeController@index')->name('home');
