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

Route::group(['namespace' => 'Api'], function () {

    Route::group(['middleware' => 'auth:api'], function () {

        Route::get('/user', function (Request $request) {
            return $request->user();
        });

        Route::post('/upload', 'FileController@store')->middleware('permission:CreatePublications');
        Route::post('/logout', 'AuthController@logout');
        Route::post('/board', 'BoardController@store')->middleware('permission:CreateBoards');

        Route::group(['prefix' => '/board/{board}'], function () {
            Route::group(['middleware' => 'permission:CreatePublications'], function () {
                Route::post('/', 'ThreadController@store');
                Route::post('/thread/{thread}', 'PostController@store');
            });

            Route::group(['middleware' => 'permission:DeletePublications', 'prefix' => '/thread/{thread}'], function () {
                Route::delete('/', 'ThreadController@delete');
                Route::delete('/{post}', 'ThreadController@delete');
            });
        });

    });

    Route::post('/login', 'AuthController@login');
    Route::post('/register', 'AuthController@register');
    Route::get('/boards', 'BoardController@index');

    Route::group(['prefix' => '/board/{board}'], function () {
        Route::get('/', 'BoardController@show');
        Route::get('/threads', 'BoardController@showThreads');
        Route::get('/thread/{thread}', 'ThreadController@show');
    });

    Route::group(['prefix' => '/user/{user}'], function () {
        Route::get('/', 'UserController@show');
    });
});
