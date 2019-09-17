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

Route::get('/', 'HomeController@index')->name('front');
Route::get('/preregister', 'PacientController@preregister')->name('preregister');

Route::get('/helpdesk', 'HomeController@helpdesk')->name('helpdesk');

Route::get('/products', 'ProductController@index')->name('products.index');
Route::get('/products/{id}/edit', 'ProductController@edit')->name('products.edit');

// Save methods
Route::post('/products/new', 'HomeController@store')->name('products.store');
Route::post('/accounts/new', 'HomeController@account')->name('accounts.new');
Route::post('/help/desk', 'HomeController@createhelp')->name('help.new');
