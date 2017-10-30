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
//irshad
Route::get('/', function () {
    return view('welcome');
});


//admin login

Route::get('/admin', function () {
    return view('admin/login');
});
Auth::routes();
Route::get('admin/dashboard', 'admin\DashboardController@index');

//
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home1', 'HomeController@index')->name('home');
Route::get('/irshad27', 'HomeController@irshad27')->name('irshad27');
