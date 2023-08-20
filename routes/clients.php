<?php

use Illuminate\Support\Facades\Route;

Route::name('client.')->prefix('dashboard/client/')->group(function () {
    Route::namespace('Client\Auth')->group(function () {
        Route::get('login',                             'LoginController@showLoginForm')->name('login.show');
        Route::post('login',                            'LoginController@login')->name('login');
        Route::post('logout',                           'LoginController@logout')->name('logout');
        Route::get('password/reset',                    'ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('password/email',                   'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::get('password/reset/{token}',            'ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('password/reset',                   'ResetPasswordController@reset')->name('password.update');
    });
    Route::namespace('Client')->group(function () {
        //start ReceiptController
        Route::get('/receipts/qr_receipt/{base_encode}', 'ClientController@qrReceipt')->name('show.qr.receipt');
        Route::get('/lawsuites/qr_contract/{base_encode}', 'ClientController@qrLawsuitesContract')->name('show.qr.contract');
        Route::get('/consultations/qr_contract/{base_encode}', 'ClientController@qrConsultationContract')->name('show.qr.consultation.contract');
    });
    Route::namespace('Client')->middleware(['auth:client', 'check.status'])->group(function () {
        Route::get('/', 'ClientController@dashboard')->name('dashboard');
        
        //start CalendarController
        Route::get('/account_settings',  'ClientController@profile')->name('account_settings');
        Route::post('/account_settings',  'ClientController@profileUpdate');

        Route::get('/lawsuite/{id}', 'ClientController@showLawsuite')->name('lawsuite');
        Route::get('/consultation/{id}', 'ClientController@showConsultation')->name('consultation');
    });
});
