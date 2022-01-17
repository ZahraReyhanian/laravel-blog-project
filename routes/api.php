<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('v1')->namespace('App\Http\Controllers\api\v1')->group(function (){

    Route::prefix('auth')->namespace('auth')->group(function (){
        Route::post('login', 'LoginController@login');
        Route::post('register', 'RegisterController@register');
    });

    Route::prefix('post')->namespace('post')->group(function (){
        Route::get('/', 'PostController@index');
        Route::get('/{post}', 'PostController@show');

        Route::middleware('auth:sanctum')->group(function (){
            //store, edit, update, delete, like, comment
            Route::post('/', 'PostController@store');
            Route::put('/{post}', 'PostController@update');
            Route::delete('/{post}', 'PostController@destroy');

            Route::post('/{post}/like', 'LikeController@favoritePost');
            Route::post('/{post}/unlike', 'LikeController@unFavoritePost');


            Route::post('/comment', 'CommentController@index');

            Route::put('/comment/{comment}', 'CommentController@confirm');
            Route::put('/comment/{comment}/unconfirm', 'CommentController@unconfirm');
            Route::delete('/comment/{comment}', 'CommentController@delete');
        });
    });

    Route::prefix('category')->namespace('category')->group(function (){
        Route::get('/', 'CategoryController@index');
        Route::get('/{category}', 'CategoryController@show');

        Route::middleware('auth:sanctum')->group(function (){
            //store, edit, update, delete, like, comment
            Route::post('/', 'CategoryController@store');
            Route::put('/{category}', 'CategoryController@update');
            Route::delete('/{category}', 'CategoryController@destroy');
        });
    });



});



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
