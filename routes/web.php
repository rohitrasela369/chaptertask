<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/customer', 'CustomerController@index')->name('customer.list');
    Route::post('/customer/get-all', 'CustomerController@getAll')->name('customer.get');

    Route::get('/product', 'ProductController@index')->name('product.list');
    Route::post('/product/get-all', 'ProductController@getAll')->name('product.get');

    Route::get('/order', 'OrderController@index')->name('order.list');
    Route::get('/order/show/{id?}', 'OrderController@show')->name('order.show');
    Route::post('/order/get-all', 'OrderController@getAll')->name('order.get');
});

Route::get('/home', 'HomeController@index')->name('home');
