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
//irshad master

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', 'HomeController@index');
Route::get('llc/start', 'LlcController@index');
Route::post('llc/package', 'LlcController@select_package');
Route::get('llc/package', 'LlcController@select_package');
Route::get('getstateprice', 'LlcController@getstateprice');
Route::post('llc/contact', 'LlcController@llc_contact');
Route::post('llc/business_info', 'LlcController@llc_business_info');
Route::post('llc/comliance', 'LlcController@llc_comliance');
Route::any('llc/place-order', 'LlcController@llc_place_order');






#PAUMONEY PAYMENT
Route::post('payumoney/checkout', 'payment\PayuPament@paymentRequest');
Route::post('payumoney/success', 'payment\PayuPament@paymentSuccess');
Route::post('payumoney/failure', 'payment\PayuPament@paymentFailure');



#PAYPAL PAYMENT
Route::post('paypal', 'payment\PayPalController@index');
Route::get('paypal/ec-checkout', 'payment\PayPalController@getExpressCheckout');
Route::get('paypal/ec-checkout-success', 'payment\PayPalController@getExpressCheckoutSuccess');
Route::post('paypal/notify', 'payment\PayPalController@notify');
Route::get('paypal/success', 'payment\PayPalController@success');
Route::get('paypal/failure', 'payment\PayPalController@failure');

#faq site url
Route::get('faq/{slug}', 'FaqController@index');

#admin login
Route::get('/admin/login', function () {
    if(Auth::check()){return Redirect::to('admin/dashboard');}
    return view('admin/login');
});


Route::post('/admin/login', [ 'as' => 'login', 'uses' => 'Auth\LoginController@authenticate']);
Route::post('/admin/logout', [ 'as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

Route::get('/admin', function () {
    if(Auth::check()){return Redirect::to('admin/dashboard');}
    return view('admin/login');
});

//Auth::routes();
Route::get('admin/dashboard', 'admin\DashboardController@index');

# Admin Panel Routes
//user routes
Route::get('admin/user/create', 'admin\UserController@create');
Route::post('admin/store', 'admin\UserController@store');
Route::post('admin/update', 'admin\UserController@update');
Route::get('admin/user', 'admin\UserController@index');
Route::post('admin/user', 'admin\UserController@index');
Route::get('admin/user/{id}/edit', 'admin\UserController@edit');
Route::get('admin/user/{id}/delete', 'admin\UserController@destroy');
Route::get('admin/user/status/{id}', 'admin\UserController@changeStatus');
Route::post('admin/mobilecheck', 'admin\UserController@mobileCheck');
Route::get('admin/user/{id}', 'admin\UserController@show');

//Faq routes
//category
Route::get('admin/faq/category', 'admin\FaqController@index');
Route::post('admin/faq/category', 'admin\FaqController@index');
Route::get('admin/faq/category/create', 'admin\FaqController@createCategory');
Route::post('admin/faq/category/store', 'admin\FaqController@storeCategory');
Route::get('admin/faq/category/{id}/edit', 'admin\FaqController@editCategory');
Route::post('admin/faq/category/update', 'admin\FaqController@updateCategory');
Route::get('admin/faq/category/{id}/delete', 'admin\FaqController@destroyCategory');
Route::get('admin/faq/category/status/{id}', 'admin\FaqController@changeCategoryStatus');
Route::get('admin/faq/category/{id}', 'admin\FaqController@showCategory');

//question
Route::get('admin/faq/question', 'admin\FaqController@question');
Route::post('admin/faq/question', 'admin\FaqController@question');
Route::get('admin/faq/question/create', 'admin\FaqController@createQuestion');
Route::post('admin/faq/question/store', 'admin\FaqController@storeQuestion');
Route::get('admin/faq/question/{id}/edit', 'admin\FaqController@editQuestion');
Route::post('admin/faq/question/update', 'admin\FaqController@updateQuestion');
Route::get('admin/faq/question/{id}/delete', 'admin\FaqController@destroyQuestion');
Route::get('admin/faq/question/{id}', 'admin\FaqController@showQuestion');
Route::get('admin/faq/question/status/{id}', 'admin\FaqController@changeQuestionStatus');


#plans
Route::resource('admin/plans', 'admin\PlansController', ['only' => [
    'create', 'store', 'update','index'
]]);
Route::get('admin/plans/{id}/delete', 'admin\PlansController@destroy');
Route::get('admin/plans/{id}/edit', 'admin\PlansController@edit');
Route::get('admin/plans/{id}', 'admin\PlansController@show');
Route::get('admin/plans/status/{id}', 'admin\PlansController@changeStatus');
Route::post('admin/plans/index', 'admin\PlansController@index');

#Package
Route::resource('admin/package', 'admin\PackageController', ['only' => [
    'create', 'store', 'update','index'
]]);
Route::get('admin/package/{id}/delete', 'admin\PackageController@destroy');
Route::get('admin/package/{id}/edit', 'admin\PackageController@edit');
Route::get('admin/package/{id}', 'admin\PackageController@show');
Route::get('admin/package/status/{id}', 'admin\PackageController@changeStatus');
Route::post('admin/package/index', 'admin\PackageController@index');

#package Addtional Items
Route::resource('admin/additional-item', 'admin\AdditionalItemController', ['only' => [
    'create', 'store', 'update','index'
]]);
Route::get('admin/additional-item/{id}/delete', 'admin\AdditionalItemController@destroy');
Route::get('admin/additional-item/{id}', 'admin\AdditionalItemController@show');
Route::get('admin/additional-item/{id}/edit', 'admin\AdditionalItemController@edit');
Route::get('admin/additional-item/status/{id}', 'admin\AdditionalItemController@changeStatus');
Route::post('admin/additional-item/index', 'admin\AdditionalItemController@index');

