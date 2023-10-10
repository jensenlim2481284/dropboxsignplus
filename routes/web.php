<?php

use Illuminate\Support\Facades\Route;


# Route namespace
Route::group(['namespace' => 'App\Http\Controllers\Web'], function () {

    # Homepage 
    Route::get('/', ['as' => 'index','uses' => 'IndexController@index']);

});
