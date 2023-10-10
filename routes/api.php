<?php



Route::post('/callback', ['as' => 'callback','uses' => 'App\Http\Controllers\APIController@callback']);
Route::post('/track', ['as' => 'track','uses' => 'App\Http\Controllers\APIController@track']);
