<?php

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

Route::post('/login', 'API\AuthController@login');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('products', 'API\ProductController@index');
    Route::post('product', 'API\ProductController@store');
    Route::put('product/{id}', 'API\ProductController@update');
    Route::post('product/{id}', 'API\ProductController@destroy');
    Route::post('product/restore/{id}', 'API\ProductController@restore');
});


