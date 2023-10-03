<?php


# Dashboard route namespace
Route::group(['namespace' => 'App\Http\Controllers\Dashboard'], function () {

    Route::post('/receiveQR', ['as' => 'receive','uses' => 'APIController@receive']);

});