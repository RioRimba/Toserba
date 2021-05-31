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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

route::post('register', 'App\Http\Controllers\userController@register');
route::post('login', 'App\Http\Controllers\userController@login');

route::group(['middleware' => ['jwt.verify:pelanggan,kasir']],function(){ 
	route::get('/get_barang','App\Http\Controllers\barangController@index');
	route::get('/get_barang/{id_barang}','App\Http\Controllers\barangController@search');
});

route::group(['middleware' => ['jwt.verify:kasir']],function(){ 
	route::post('/insert_barang','App\Http\Controllers\barangController@add');
	route::get('/detail_barang/{id}','App\Http\Controllers\barangController@detail');
	route::put('/editbarang/{id}','App\Http\Controllers\barangController@editbarang');
	route::delete('/deletebarang/{id}','App\Http\Controllers\barangController@deletebarang');
});