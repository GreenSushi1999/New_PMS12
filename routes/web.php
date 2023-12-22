<?php
use App\Http\Controllers\AuthController;

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
Route::middleware(['web', 'auth.check'])->group(function () {
    Route::get('/login', 'PerformanceController@loginform');
    Route::post('/login', 'PerformanceController@login')->name('login');

});

Route::get('/logout', 'PerformanceController@logout')->name('logout');

Route::middleware(['web', 'custom.auth'])->group(function () {
    Route::get('/index', 'PerformanceController@index');
    Route::post('/access-performance', 'PerformanceController@access_performacne')->name('access-performance');
    Route::post('/move-info', 'PerformanceController@move_info')->name('move-info');
    Route::post('/save-info', 'PerformanceController@save_info')->name('save-info');
    Route::post('/values', 'PerformanceController@values')->name('values');
    Route::get('/instruction/{performance_cid}/{ratee_cid}', 'PerformanceController@instruction');
    Route::get('/values-indicator/{performance_cid}/{ratee_cid}', 'PerformanceController@values_indicator');
    Route::post('/save-ratings', 'PerformanceController@save_ratings')->name('save-ratings');
    Route::get('/achievements/{performance_cid}/{ratee_cid}', 'PerformanceController@achievements');
    Route::post('/update-achievement', 'PerformanceController@update_achievement')->name('update-achievement');
    Route::post('/add-achievement', 'PerformanceController@add_achievement')->name('add-achievement');
    Route::post('/delete-achievement', 'PerformanceController@delete_achievement')->name('delete-achievement');
    Route::post('/update-and-next', 'PerformanceController@updateAndNext')->name('updateAndNext');
    Route::get('/recommendations/{performance_cid}/{ratee_cid}', 'PerformanceController@recommendations');
    Route::post('/add-recommendation', 'PerformanceController@add_recommendation')->name('add-recommendation');
    Route::post('/updateRec-and-next', 'PerformanceController@updateRecAndNext')->name('updateRecAndNext');
    Route::post('/delete-recommendation', 'PerformanceController@delete_recommendation')->name('delete-recommendation');
    Route::post('/update-recommendation', 'PerformanceController@update_recommendation')->name('update-recommendation');
    Route::get('/agreement/{performance_cid}/{ratee_cid}', 'PerformanceController@agreement');
    Route::post('/save-performance-agreement', 'PerformanceController@save_perfagreement')->name('save-perf_agreement');


});


Route::get('/pms/edit/rank-and-file-level', 'PerformanceController@editRank');
Route::get('/pms/edit/supervisory-officer-level', 'PerformanceController@editSupervisory');
Route::post('/edit-values', 'PerformanceController@edit_values')->name('edit-values');
Route::get('/get-criteria', 'PerformanceController@getCriteria')->name('get-criteria');