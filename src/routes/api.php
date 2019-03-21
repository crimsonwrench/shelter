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

    Route::get('/boards', 'BoardController@index')->name('boards');

    Route::group(['prefix' => '/board/{boardName}'], function () {

        Route::get('/', 'BoardController@show')->name('board.show');

        //Thread routes
        Route::group(['as' => 'threads.', 'prefix' => '/thread'], function () {
            Route::get('{num}', 'PostController@showThread')->name('show');
            Route::post('/', 'PostController@storeThread')->name('create');
            Route::delete('{num}', 'PostController@delete')->name('delete')
                ->middleware('role:admin');
        });

        //Post routes
        Route::group(['as' => 'posts.', 'prefix' => '/post'], function () {
            Route::get('{num}', 'PostController@showPost')->name('show');
            Route::post('/', 'PostController@storePost')->name('create');
            Route::delete('{num}', 'PostController@delete')->name('delete')
            ->middleware('role:admin');
        });
    });
});