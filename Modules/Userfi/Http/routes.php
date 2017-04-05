<?php

Route::group(['middleware' => 'web', 'prefix' => 'userfi', 'namespace' => 'Modules\Userfi\Http\Controllers'], function()
{
    Route::get('/', 'UserfiController@index');
});
