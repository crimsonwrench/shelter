<?php

use App\Http\Middleware\CheckVisitor;

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

Route::group(['middleware' => ['visitor']], function () {

    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

        //Admin control panel routes
        Route::group(['namespace' => 'Admin', 'as' => 'admin.'], function () {
                Route::get('panel', 'AdminController@index')->name('index');
        });
    });

    Route::get('/', 'BoardController@index')->name('boards.list');

    // Main board routes
    Route::group(['prefix' => '{board}'], function () {

        Route::group(['as' => 'boards.'], function () {
            Route::get('/', 'BoardController@showBoard')->name('show');

            //TODO: create, edit, destroy boards
            Route::post('/', function () {
            })->name('create');

            Route::post('/', function () {
            })->name('edit');

            Route::post('/', function () {
            })->name('destroy');
        });

        //Thread routes
        Route::group(['as' => 'threads.'], function () {
            Route::get('/res/{thread}/', 'PostController@showThread')->name('show');
            Route::post('/', 'PostController@storeThread')->name('create');
            Route::get('/res/{thread}/delete', 'PostController@deleteThread')->name('delete')
                ->middleware('role:admin');
        });

        //Post routes
        Route::group(['as' => 'posts.'], function () {
            Route::post('/res/{thread}', 'PostController@storePost')->name('create');
        });
    });
});
