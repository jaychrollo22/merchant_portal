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

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/register-merchant', 'MerchantController@register');
Route::post('/store-register-merchant', 'MerchantController@storeRegister');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Products
Route::get('/products', 'ProductController@index')->name('merchant');
Route::get('/create-product', 'ProductController@create');
Route::get('/edit-product', 'ProductController@edit');
Route::post('/store-product', 'ProductController@store');
Route::post('/update-product', 'ProductController@update');

// Merchant
Route::get('/merchants', 'MerchantController@index')->name('merchant');
Route::get('/create-merchant', 'MerchantController@create');
Route::get('/edit-merchant/{id}', 'MerchantController@edit');
Route::post('/store-merchant', 'MerchantController@store');
Route::post('/update-merchant/{merchant}', 'MerchantController@update');

// Users
Route::get('/users', 'UserController@index')->name('user');
Route::get('/create-user', 'UserController@create');
Route::get('/edit-user', 'UserController@edit');
Route::get('/change-password-user', 'UserController@changePassword');
Route::post('/store-user', 'UserController@store');
Route::post('/update-user', 'UserController@update');



