<?php


//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/', 'ViewController@index')->name('/');

//Route::resource('user', 'UserController');

Route::group(['as' => 'admin.', 'namespace' => 'Admin', 'prefix' => 'admin',
    'middleware' => ['admin', 'auth:web']], function () {

    //Route::resource('dashboard', 'DashboardController');

});

Route::group(['as' => 'user.', 'namespace' => 'User', 'prefix' => 'user',
    'middleware' => ['user', 'auth:web']], function () {

    //Route::resource('dashboard', 'DashboardController');

});