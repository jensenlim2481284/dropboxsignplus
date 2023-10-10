<?php

use Illuminate\Support\Facades\Route;


# Route namespace
Route::group(['namespace' => 'App\Http\Controllers'], function () {

    # Homepage 
    Route::get('/', ['as' => 'index','uses' => 'IndexController@index']);

    # Sign Page 
    Route::get('/sign', ['as' => 'sign','uses' => 'IndexController@sign']);

    # Report Page 
    Route::get('/report', ['as' => 'report','uses' => 'IndexController@report']);

});
