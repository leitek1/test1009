<?php

use App\Http\Controllers\MainController;
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


Route::get('/', 'App\Http\Controllers\MainController@home');
Route::post('/convert', 'App\Http\Controllers\MainController@toconvert');
Route::get('/review', 'App\Http\Controllers\MainController@review')->name('review');
Route::post('/review/check', 'App\Http\Controllers\MainController@review_check');