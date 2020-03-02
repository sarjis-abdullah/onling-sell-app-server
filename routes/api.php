<?php
Route::apiResource('category', 'CategoryController');
Route::apiResource('post', 'PostController');
Route::post('post-search', 'PostController@search');
Route::apiResource('registration', 'RegistrationController');
Route::get('searchByLocation', 'PostController@searchByLocation');
Route::group([

    'prefix' => 'auth'

], function () {

    Route::post('login', 'AuthController@login');


    Route::group([
        'middleware' => 'auth:api',
    ] , function (){

        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::post('me', 'AuthController@me');
        Route::post('save', 'AuthController@save');
        Route::apiResource('user', 'UserController');



    });



});


