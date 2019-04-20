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

    Route::group(['middleware' => 'auth:api'], function () {

        Route::post('/upload', 'FileController@store');
        Route::post('/logout', 'AuthController@logout');

        Route::group(['prefix' => '/board/{board}'], function () {
            Route::group(['middleware' => 'permission:CreatePublications'], function () {
                Route::post('/', 'ThreadController@store');
                Route::post('/thread/{thread}', 'PostController@store');
            });

            Route::group(['middleware' => 'permission:DeletePublications', 'prefix' => '/thread/{thread}'], function () {
                Route::delete('/', 'ThreadController@destroy');
                Route::delete('/{post}', 'ThreadController@destroy');
            });
        });

    });

    Route::post('/login', 'AuthController@login');
    Route::post('/register', 'AuthController@register');
    Route::get('/boards', 'BoardController@index');

    Route::group(['prefix' => '/board/{board}'], function () {
        Route::get('/', 'BoardController@show');
        Route::get('/thread/{thread}', 'ThreadController@show');
    });
});
