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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//Route::middleware('premium')->get('get-lessons', 'LessonController@index');
//    Route::resources([
//        'lessons' => 'LessonController',
//    ]);

Route::group(['prefix' => 'v1'], function (){

    Route::post('login', 'AuthController@login');
    Route::resource('lessons', 'LessonController', ['middleware' => 'auth.token']);
    Route::get('lessons/{id}/tags', 'tagController@index');
    Route::resource('tags', 'tagController', ['only' => ['index', 'show']]);

});
