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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'user'], function() {
        Route::get('profile/{id}', 'ProfileController@show');
        Route::get('editprofile/{id}', 'ProfileController@edit');
        Route::post('profile/simpanphoto', 'ProfileController@simpanphoto')->name('simpanphoto');
        Route::post('updateprofile/{id}', 'ProfileController@update')->name('updateprofile');
});
Route::group(['prefix'=>'product'], function(){
    Route::get('index', 'ProductController@index');
    Route::get('create', 'ProductController@create');
    Route::post('store', 'ProductController@store')->name('storeproduct');
    Route::get('edit/{id}', 'ProductController@edit');
    Route::get('destroy/{id}', 'ProductController@destroy');
    Route::post('destroyall', 'ProductController@destroyall')->name('destroyallproduct');
    Route::post('update/{id}', 'ProductController@update')->name('updateproduct');
});
Route::group(['prefix'=>'order'], function(){
    Route::get('index', 'OrderController@index')->name('orderlist');
    Route::get('productlist', 'OrderController@productlist')->name('productlist');
    Route::get('editproductlist/{id}', 'OrderController@editproductlist')->name('editproductlist');
    Route::get('create', 'OrderController@create');
    Route::post('storeorder', 'OrderController@store')->name('storeorder');
    Route::get('edit/{id}', 'OrderController@edit');
    Route::get('destroy/{id}', 'OrderController@destroy');
    Route::post('destroyall', 'OrderController@destroyall')->name('destroyallorder');
    Route::post('update/{id}', 'OrderController@update')->name('updateorder');
    Route::get('invoice/{id}', 'OrderController@invoice');
    Route::get('invoicelist', 'OrderController@invoicelist')->name('invoicelist');
    Route::get('editinvoice/{id}', 'OrderController@editinvoice')->name('editinvoice');
    Route::post('updateinvoice/{id}', 'OrderController@updateinvoice')->name('updateinvoice');
});
    
    //contoh routing laravel
// Route::group(array('prefix'=>'user'), function(){
//     Route::get('profile/{id}', 'ProfileController@show')->name('show');
//     Route::get('profile/{id}', [ProfileController::class, 'show'])->name('show');
// });