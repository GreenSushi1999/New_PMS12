<?php

use App\Http\Controllers\PerformanceController;

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

Route::get('/index', 'PerformanceController@index');
Route::post('/move-info', 'PerformanceController@move_info')->name('move-info');
Route::post('/save-info', 'PerformanceController@save_info')->name('save-info');
Route::post('/values', 'PerformanceController@values')->name('values');
Route::get('/instruction/{performance_cid}/{ratee_cid}', 'PerformanceController@instruction');
Route::get('/values-indicator/{performance_cid}/{ratee_cid}', 'PerformanceController@values_indicator');

