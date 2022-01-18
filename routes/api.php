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

        Route::post('/password/email', 'ResetController@sendPasswordResetLinkEmail')->middleware('throttle:5,1')->name('password.email');
        Route::post('/password/reset', 'ResetController@resetPassword')->name('password.reset');
    });

    Route::prefix('auth')->namespace('authorization')->middleware('auth:sanctum')->group(function (){
        //permissions
        Route::apiResource('permissions', 'PermissionController');

        //role
        Route::apiResource('roles', 'RoleController');

        //user permission
        Route::post('permissions/{user}', 'UserPermissionController@store');
        Route::get('permissions/{user}', 'UserPermissionController@index');

    });

    Route::namespace('post')->group(function (){
        Route::apiResource('posts', 'PostController');

        Route::middleware('auth:sanctum')->group(function (){
            //like, comment
            Route::post('/{post}/like', 'LikeController@favoritePost');
            Route::post('/{post}/unlike', 'LikeController@unFavoritePost');


            Route::prefix('comment')->group(function (){
                Route::post('/', 'CommentController@comment');

                Route::get('/', 'CommentController@index');
                Route::get('/{comment}', 'CommentController@show');
                Route::put('/{comment}', 'CommentController@confirm');
                Route::put('/{comment}/unconfirm', 'CommentController@unconfirm');
                Route::delete('/{comment}', 'CommentController@delete');
            });

        });
    });

    Route::namespace('category')->group(function (){
        Route::apiResource('categories', 'CategoryController');
    });



});
