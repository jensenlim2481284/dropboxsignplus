<?php

URL::forceScheme('https'); 

# Second app route namespace
Route::group(['namespace' => 'App\Http\Controllers\PWA'], function () {

    # Homepage 
    Route::get('/', ['as' => 'index','uses' => 'IndexController@index']);

});
