<?php

URL::forceScheme('https'); 

# Second app route namespace
Route::group(['namespace' => 'App\Http\Controllers\Web'], function () {

    # Homepage 
    Route::get('/', ['as' => 'index','uses' => 'IndexController@index']);

});
