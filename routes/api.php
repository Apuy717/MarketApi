<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "API" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('details', 'API\UserController@details');
    Route::post('logout', 'API\UserController@logout');

    Route::group(['prefix' => 'barang'], function () {
        Route::get('/', 'API\Barang\BarangController@index');
        Route::get('/{id}', 'API\Barang\BarangController@byId');
        Route::get('/details/{code}', 'API\Barang\BarangController@byCode');
        Route::get('/empty/stock', 'API\Barang\BarangController@getNull');
        Route::post('/add/{idSup}', 'API\Barang\BarangController@store');
        Route::post('/edit/{id}', 'API\Barang\BarangController@update');
        Route::delete('/delete/{id}', 'API\Barang\BarangController@delete');
        Route::get('/category/items', 'API\Barang\BarangController@categoryGet');
        Route::post('/category/items/add', 'API\Barang\BarangController@storeCatgeory');
        Route::post('/unit/items/add', 'API\Barang\BarangController@storeUnit');
        Route::delete('/unit/items/delete/{id}', 'API\Barang\BarangController@deleteUnit');
        Route::delete('/category/items/delete/{id}', 'API\Barang\BarangController@deleteCategory');
    });

    Route::group(['prefix' => 'transaksi'], function () {
        Route::get('/', 'API\Transaksi\TransaksiController@index');
        Route::get('/detail/{id}', 'API\Transaksi\TransaksiController@ShowById');
        Route::get('/item/{code}', 'API\Transaksi\TransaksiController@getItems');
        Route::get('/item/members/{code}', 'API\Transaksi\TransaksiController@getItemsMembers');
        Route::get('/item/seller/{code}', 'API\Transaksi\TransaksiController@getItemSeller');
        Route::post('/add/umumku', 'API\Transaksi\TransaksiController@storeUmum');
        Route::post('/add/{params}', 'API\Transaksi\TransaksiController@store');
        Route::post('/edit/{id}', 'API\Transaksi\TransaksiController@update');
        Route::delete('/delete/{id}', 'API\Transaksi\TransaksiController@delete');
    });
    Route::group(['prefix' => 'income'], function () {
        Route::get('/', 'API\Income\IncomeController@index');
    });

    Route::group(['prefix' => 'members'], function () {
        Route::get('/', 'API\Members\MembersController@index');
        Route::get('/detail/{id}', 'API\Members\MembersController@byId');
        Route::post('/add', 'API\Members\MembersController@store');
        Route::post('/edit/{id}', 'API\Members\MembersController@update');
        Route::delete('/delete/{id}', 'API\Members\MembersController@delete');
    });

    Route::group(['prefix' => 'suppiler'], function () {
        Route::get('/', 'API\Suppiler\suppilerController@index');
        Route::get('/{id}', 'API\Suppiler\suppilerController@byId');
        Route::get('/details/{id}', 'API\Suppiler\suppilerController@detail');
        Route::post('/add', 'API\Suppiler\suppilerController@store');
        Route::post('/edit/{id}', 'API\Suppiler\suppilerController@update');
        Route::delete('/delete/{id}', 'API\Suppiler\suppilerController@delete');
    });
});
