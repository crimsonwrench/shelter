<?php

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

Route::group(['namespace' => 'Api'], function () {

    Route::post('/upload', 'FileController@store');

    Route::get('/boards', 'BoardController@index');

    Route::group(['prefix' => '/board/{board}'], function () {

        Route::get('/', 'BoardController@show');
        Route::post('/', 'ThreadController@store');

        Route::group(['prefix' => 'thread'], function () {
            
            Route::get('{thread}', 'ThreadController@show');
            Route::delete('{thread}', 'ThreadController@destroy');

            Route::group(['prefix' => '{thread}'], function () {
                Route::post('/', 'PostController@store');
                Route::delete('{post}', 'PostController@destroy');
            });
        });
    });
});
