<?php

Route::group(['middleware' => 'web', 'prefix' => 'prappo', 'namespace' => 'Modules\Prappo\Http\Controllers'], function()
{
    Route::get('/', 'PrappoController@index');
});
