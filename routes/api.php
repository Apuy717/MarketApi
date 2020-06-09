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
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('details', 'API\UserController@details');
    Route::post('logout', 'API\UserController@logout');

    Route::group(['prefix' => 'barang'], function () {
        Route::get('/', 'Api\Barang\BarangController@index');
        Route::get('/{id}', 'Api\Barang\BarangController@byId');
        Route::get('/details/{code}', 'Api\Barang\BarangController@byCode');
        Route::get('/empty/stock', 'Api\Barang\BarangController@getNull');
        Route::post('/add/{idSup}', 'Api\Barang\BarangController@store');
        Route::post('/edit/{id}', 'Api\Barang\BarangController@update');
        Route::delete('/delete/{id}', 'Api\Barang\BarangController@delete');
        Route::get('/category/items', 'Api\Barang\BarangController@categoryGet');
        Route::post('/category/items/add', 'Api\Barang\BarangController@storeCatgeory');
        Route::post('/unit/items/add', 'Api\Barang\BarangController@storeUnit');
        Route::delete('/unit/items/delete/{id}', 'Api\Barang\BarangController@deleteUnit');
        Route::delete('/category/items/delete/{id}', 'Api\Barang\BarangController@deleteCategory');
    });

    Route::group(['prefix' => 'transaksi'], function () {
        Route::get('/', 'Api\Transaksi\TransaksiController@index');
        Route::get('/detail/{id}', 'Api\Transaksi\TransaksiController@ShowById');
        Route::get('/item/{code}', 'Api\Transaksi\TransaksiController@getItems');
        Route::get('/item/members/{code}', 'Api\Transaksi\TransaksiController@getItemsMembers');
        Route::get('/item/seller/{code}', 'Api\Transaksi\TransaksiController@getItemSeller');
        Route::post('/add/umumku', 'Api\Transaksi\TransaksiController@storeUmum');
        Route::post('/add/{params}', 'Api\Transaksi\TransaksiController@store');
        Route::post('/edit/{id}', 'Api\Transaksi\TransaksiController@update');
        Route::delete('/delete/{id}', 'Api\Transaksi\TransaksiController@delete');
    });
    Route::group(['prefix' => 'income'], function () {
        Route::get('/', 'API\Income\IncomeController@index');
    });

    Route::group(['prefix' => 'members'], function () {
        Route::get('/', 'Api\Members\MembersController@index');
        Route::get('/detail/{id}', 'Api\Members\MembersController@byId');
        Route::post('/add', 'Api\Members\MembersController@store');
        Route::post('/edit/{id}', 'Api\Members\MembersController@update');
        Route::delete('/delete/{id}', 'Api\Members\MembersController@delete');
    });

    Route::group(['prefix' => 'suppiler'], function () {
        Route::get('/', 'Api\Suppiler\suppilerController@index');
        Route::get('/{id}', 'Api\Suppiler\suppilerController@byId');
        Route::get('/details/{id}', 'Api\Suppiler\suppilerController@detail');
        Route::post('/add', 'Api\Suppiler\suppilerController@store');
        Route::post('/edit/{id}', 'Api\Suppiler\suppilerController@update');
        Route::delete('/delete/{id}', 'Api\Suppiler\suppilerController@delete');
    });
});
