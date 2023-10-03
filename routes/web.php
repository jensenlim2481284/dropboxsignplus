<?php

use Illuminate\Support\Facades\Route;


//Localization
Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']],function()
{
    require base_path('routes/route_group/' .env("APP_ID") . '.php');
});