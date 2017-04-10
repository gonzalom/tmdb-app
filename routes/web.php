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
    //return view('welcome');
    return redirect()->route('app');
});

Auth::routes();

Route::get('/app/{any?}', ['uses' => 'AppController',  'as' => 'app'])->where('any', '.*');

Route::group(['namespace' => 'Tmdb', 'prefix' => 'api', 'as' => 'api.'], function () {
    Route::resource('movie', 'MovieController', ['only' => [
        'index', 'show'
    ]]);

    Route::get('genre/{genre}/movies', ['uses' => 'GenreController@movies', 'as' => 'genre.movies'])
        ->where('genre', '[0-9]+');

    Route::resource('genre', 'GenreController', ['only' => [
        'index', 'show'
    ]]);

    Route::get('search/movie', ['uses' => 'SearchController@movies', 'as' => 'search.movie']);
});
