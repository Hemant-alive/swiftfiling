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
    return view('welcome');
});


//admin login

Route::get('/admin', function () {
    return view('admin/login');
});
Auth::routes();
Route::get('admin/dashboard', 'admin\DashboardController@index');

# Admin Panel Routes
Route::get('admin/users/create', 'UserController@create');
Route::post('admin/store', 'UserController@store');
Route::post('admin/update', 'UserController@update');
Route::get('admin/userList', 'UserController@index');
Route::get('admin/users/{id}/edit', 'UserController@edit');
Route::get('admin/users/{id}/delete', 'UserController@destroy');
Route::get('admin/user/status/{id}', 'UserController@changeStatus');
//Route::resource('admin/users', 'RegistrationController');


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home1', 'HomeController@index')->name('home');
