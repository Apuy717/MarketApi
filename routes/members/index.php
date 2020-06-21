<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'suppiler'], function () {
    Route::get('/', 'API\Suppiler\suppilerController@index');
    Route::get('/recyclebin/suppiler', 'API\Suppiler\suppilerController@recycleBin');
    Route::get('/{id}', 'API\Suppiler\suppilerController@byId');
    Route::get('/details/{id}', 'API\Suppiler\suppilerController@detail');
    Route::post('/add', 'API\Suppiler\suppilerController@store');
    Route::post('/edit/{id}', 'API\Suppiler\suppilerController@update');
    Route::delete('/delete/{id}', 'API\Suppiler\suppilerController@delete');
});
