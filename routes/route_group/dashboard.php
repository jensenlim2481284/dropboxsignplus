<?php

# Dashboard route namespace
Route::group(['namespace' => 'App\Http\Controllers\Dashboard'], function () {

    # Login Page
    Route::group(['prefix' => 'login', 'as' => 'auth.'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'AuthController@index']);
        Route::post('/', ['as' => 'submit', 'uses' => 'AuthController@login', 'middleware' => ['throttle:20,1']]);
    });

    # Logout 
    Route::get('/logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);

    # Authenticated Route 
    Route::group(['middleware' => ['auth']], function () {

        # Home Page
        Route::get('/', ['as' => 'homepage', 'uses' => 'IndexController@index']);

        # QR route 
        Route::group(['prefix' => 'qr', 'as' => 'qr.'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'QRController@index']);
            Route::get('/get/{id}', ['as' => 'index', 'uses' => 'QRController@get']);
            Route::post('/manage', ['as' => 'manage', 'uses' => 'QRController@createOrUpdate']);
            Route::post('/action', ['as' => 'action', 'uses' => 'QRController@action']);
            Route::post('/export', ['as' => 'export', 'uses' => 'QRController@export']);
            Route::delete('/delete', ['as' => 'delete', 'uses' => 'QRController@delete']);
        });

    });
});
