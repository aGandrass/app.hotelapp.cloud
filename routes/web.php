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
Route::get('/deny', function () {
	return view('deny');
});


Route::group(['middleware' => 'whitelist:group1'], function () {
	Route::get('/', function() {
		return view('auth.login');
	});

		//Auth::routes();
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    // Registration Routes
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');

    // Password Reset Routes
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

		// Payments Routes
		Route::get('/home', 'HomeController@home')->name('home');
		Route::get('/paymentsdashboard', 'HomeController@index')->name('paymentsdashboard');
		Route::get('/payments-dt', 'HomeController@indexDataTables')->name('payments-dt');
		Route::post('/payment', 'HomeController@store');
		Route::get('/deactivatePayment/{uniqupdateid}', 'HomeController@deactivate');
		Route::get('/reactivatePayment/{uniqupdateid}', 'HomeController@reactivate');
		Route::post('/editPayment', 'HomeController@edit');
		Route::post('/deletePayment', 'HomeController@delete');
		Route::post('/resendPayment', 'HomeController@resend');

		// Rates Routes
		Route::get('/ratesdashboard', 'RatesController@index');
		Route::get('/ratecalculator', 'CalculatorController@index');
		Route::post('/paxChange', 'RatesController@paxChange')->name('paxChange');
		Route::post('/dateChange', 'RatesController@dateChange')->name('dateChange');
		Route::post('/ratecodeChange', 'RatesController@ratecodeChange')->name('ratecodeChange');
		Route::post('/ratecalculate', 'CalculatorController@cal');
});
