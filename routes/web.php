<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::get('/', ['middleware' => 'guest', function()
{
    return view('auth.login');
}]);

Route::group(['prefix' => 'product','middleware' => ['auth']], function () {
    Route::get('/', 'ProductController@index')->name('products');
    Route::post('/', 'ProductController@store')->name('store.product');
    Route::get('/{id}', 'ProductController@edit')->name('edit.product');
    Route::put('/{id}', 'ProductController@update')->name('update.product');
    Route::delete('/{id}', 'ProductController@destroy')->name('destroy.product');
    Route::post('/{id}', 'ProductController@restore')->name('restore.product');
});


Route::get('/product-details-history/{id}', 'DetailsPriceQuantityController@get_details_price_quantity_history')->name('show.chart');

/**Localization routes*/

Route::get('/lang/{locale}', 'Localization\LocalizationController@index');
Route::get('password/lang/{locale}', 'Localization\LocalizationController@index');
Route::get('password/reset/lang/{locale}', 'Localization\LocalizationController@index');
Route::get('product/lang/{locale}', 'Localization\LocalizationController@index');

