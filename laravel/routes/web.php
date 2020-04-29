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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/product/{id}', 'ProductController@show')->name('product.show');

Route::get('/cart', 'CartController@cart')->name('cart');
Route::post('/cart', 'CartController@add')->name('cart.add');
Route::get('/cart/remove/{id}', 'CartController@remove')->name('cart.remove');
Route::post('/cart/update', 'CartController@update')->name('cart.update');
Route::get('/checkout', 'CartController@checkout')->name('checkout');

Route::get('/order/{id}', 'OrderController@show')->name('order.detail');
Route::post('/redeem/{id}', 'OrderController@redeem')->name('redeem');
Route::get('/payment/{id}', 'OrderController@payment')->name('order.payment');
Route::get('/order', 'OrderController@list')->name('order');