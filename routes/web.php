<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.','namespace'=>'Admin' ], function () {
    Auth::routes(['register' => false]);

});

Route::group(
    [
        'prefix' => 'admin',
        'as' => 'admin.',
        'namespace'=>'Admin',
        'middleware' => [
            'auth:admin',
            'admin',
            'role:admin|superadmin',
        ]
    ],
    function () {
    Route::get('/', 'HomeController@index')->name('home');
});

Route::group(['namespace'=>'User'], function () {
    Auth::routes();
    Route::get('/home', 'HomeController@index')->name('home');
});

