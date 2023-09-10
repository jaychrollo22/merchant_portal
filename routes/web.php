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
Route::get('/register-merchant', 'RegisterMerchantController@index');
Route::post('/store-register-merchant', 'RegisterMerchantController@store');


Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Products
Route::get('/products', 'ProductController@index')->name('merchant');
Route::get('/create-product', 'ProductController@create');
Route::get('/edit-product/{id}', 'ProductController@edit');
Route::get('/info-product/{id}', 'ProductController@info');
Route::post('/store-product', 'ProductController@store');
Route::post('/update-product', 'ProductController@update');
Route::get('/remove-product-image/{id}', 'ProductController@removeImage');

// Categories
Route::get('/product-categories', 'ProductCategoryController@index')->name('category');
Route::get('/create-product-category', 'ProductCategoryController@create');
Route::get('/edit-product-category/{id}', 'ProductCategoryController@edit');
Route::post('/store-product-category', 'ProductCategoryController@store');
Route::post('/update-product-category/{id}', 'ProductCategoryController@update');

// Variants
Route::get('/product-variants', 'ProductVariantController@index')->name('variant');
Route::get('/create-product-variant', 'ProductVariantController@create');
Route::get('/edit-product-variant/{id}', 'ProductVariantController@edit');
Route::post('/store-product-variant', 'ProductVariantController@store');
Route::post('/update-product-variant/{id}', 'ProductVariantController@update');

// Merchant
Route::get('/merchants', 'MerchantController@index')->name('merchant');
Route::get('/create-merchant', 'MerchantController@create');
Route::get('/edit-merchant/{id}', 'MerchantController@edit');
Route::post('/store-merchant', 'MerchantController@store');
Route::post('/update-merchant/{merchant}', 'MerchantController@update');
Route::get('/approve-merchant/{merchant}', 'MerchantController@approveMerchant');

// Users
Route::get('/users', 'UserController@index')->name('user');
Route::get('/create-user', 'UserController@create');
Route::get('/edit-user/{user}', 'UserController@edit');
Route::get('/change-password/{user}', 'UserController@changePassword');
Route::post('/change-password-user/{user}', 'UserController@changePasswordUser');
Route::post('/store-user', 'UserController@store');
Route::post('/update-user/{user}', 'UserController@update');






