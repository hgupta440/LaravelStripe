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

Route::get('/', function(){
	return view('login');
})->name("home");
Route::post('/login', 'MainController@login');
Route::get('/product', 'ProductController@index')->middleware(['auth'])->name('product');
Route::get('/product/{product}', 'ProductController@detail')->middleware(['auth'])->name('detail');
Route::post('/product/{product}/purchase', 'ProductController@purchase')->middleware(['auth'])->name('purchase');
