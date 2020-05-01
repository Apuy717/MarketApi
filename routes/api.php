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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');
Route::get('cek', 'Api\Barang\BarangController@cek');

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('details', 'API\UserController@details');

    Route::group(['prefix' => 'barang'], function () {
        Route::get('/', 'Api\Barang\BarangController@index');
        Route::get('/{id}', 'Api\Barang\BarangController@byId');
        Route::post('/add', 'Api\Barang\BarangController@store');
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
        Route::get('/show/{id}', 'Api\Transaksi\TransaksiController@ShowById');
        Route::post('/details', 'Api\Transaksi\TransaksiController@byId');
        Route::post('/add', 'Api\Transaksi\TransaksiController@store');
        Route::post('/edit/{id}', 'Api\Transaksi\TransaksiController@update');
        Route::delete('/delete/{id}', 'Api\Transaksi\TransaksiController@delete');
    });
});
