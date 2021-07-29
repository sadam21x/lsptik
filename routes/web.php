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

// Dashboard
Route::get('/', 'DashboardController@index');

// Perhitungan Faktorial
Route::get('/faktorial', 'FaktorialController@index');
Route::post('/faktorial', 'FaktorialController@store');
Route::get('/faktorial/read-csv', 'FaktorialController@read_csv');

// Perhitungan Perpangkatan
Route::get('/perpangkatan', 'PerpangkatanController@index');
Route::post('/perpangkatan', 'PerpangkatanController@store');
Route::get('/perpangkatan/read-csv', 'PerpangkatanController@read_csv');
