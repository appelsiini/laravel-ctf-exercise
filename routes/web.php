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

Route::get('/', function () {
    if (auth()->user()) {
        return redirect('/home');
    }

    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();

Route::get('/companies', 'CompanyController@index')->name('companies');
Route::get('/companies/{company}', 'CompanyController@show');

Route::get('/jobs', 'JobController@index')->name('jobs');
Route::get('/api/jobs', Api\ListJobs::class);

Route::post('/messages', 'MessageController@store');

Route::post('/documents', 'DocumentController@store');
Route::get('/documents', 'DocumentController@index')->name('documents');
Route::get('/documents/create', 'DocumentController@create')->name('documents.create');
