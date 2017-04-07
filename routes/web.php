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

Auth::routes();

Route::get('/app', ['uses' => 'AppController',  'as' => 'app']);

Route::group(['namespace' => 'Tmdb', 'prefix' => 'api'], function () {
    Route::resource('movie', 'MovieController', ['only' => [
        'index', 'show'
    ]]);

    Route::resource('genre', 'GenreController', ['only' => [
        'index', 'show'
    ]]);
});
