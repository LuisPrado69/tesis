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
// Login
Route::get('/login', 'Business\API\LoginController@login')->name('login');

/* ------------- */
/* Profile */
/* ------------- */
Route::group([
    'prefix' => 'profile',
],
    function () {
        Route::get('/searchUserId', 'Business\API\ProfileController@searchUserId');
        Route::post('/updateUser', 'Business\API\ProfileController@updateUser');
    }
);

/* ------------- */
/* Category */
/* ------------- */
Route::group([
    'prefix' => 'category',
],
    function () {
        Route::get('/searchUserId', 'Business\API\CategoryController@searchUserId');
        Route::post('/updateUserId', 'Business\API\CategoryController@updateUserId');
    }
);
