<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhotoController;

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
Route::resource('photo', PhotoController::class);

Route::namespace('Auth')->namespace('Admin\Auth')->group(function () {
    Route::get('login',                             'LoginController@showLoginForm')->name('login.show');
    Route::post('login',                            'LoginController@login')->name('login');
    Route::post('logout',                           'LoginController@logout')->name('logout');
    Route::get('password/reset',                    'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email',                   'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}',            'ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset',                   'ResetPasswordController@reset')->name('password.update');
});

Route::name('admin.')->namespace('Admin')->group(function () {
    //start ReceiptController
    Route::get('receipts/qr_receipt/{base_encode}', 'ReceiptController@qrReceipt')->name('show.qr.receipt');
    Route::get('lawsuites/qr_contract/{base_encode}', 'LawsuiteController@qrContract')->name('show.qr.contract');
    Route::get('consultations/qr_contract/{base_encode}', 'ConsultationController@qrContract')->name('show.qr.consultation.contract');
    Route::get('payments/qr_receipt/{base_encode}', 'PaymentController@qrReceipt')->name('show.qr.payment.receipt');
});

Route::name('admin.')->namespace('Admin')->middleware(['auth:web', 'check.status'])->group(function () {
    //start AdminController
    Route::get('/', 'AdminController@index')->name('home');
    Route::get('/dashboard', 'AdminController@index');

    //start CalendarController
    Route::get('/account_settings',  'AdminController@profile')->name('account_settings');
    Route::post('/account_settings',  'AdminController@profileUpdate');

    //start CalendarController
    Route::get('calendar', 'CalendarController@index')->name('calendar');

    //start RoleController && UserController
    Route::resource('roles', 'RoleController')->except('show');
    Route::resource('users', 'UserController');

    //start ClientTypeController
    Route::post('clients-types/{client_type}/restore', 'ClientTypeController@restore')->name('clients-types.restore');
    Route::delete('clients-types/{client_type}/force-delete', 'ClientTypeController@forceDelete')->name('clients-types.force.delete');
    Route::get('clients-types/trashed', 'ClientTypeController@trashed')->name('clients-types.trashed');
    Route::resource('clients-types', 'ClientTypeController')->except(['create','show','edit']);

    //start ClientController
    Route::post('clients/{client}/restore', 'ClientController@restore')->name('clients.restore');
    Route::delete('clients/{client}/force-delete', 'ClientController@forceDelete')->name('clients.force.delete');
    Route::get('clients/trashed', 'ClientController@trashed')->name('clients.trashed');
    Route::resource('clients', 'ClientController')->except(['create','edit']);

    //start CaseTypeController
    Route::post('case-types/{case_type}/restore', 'CaseTypeController@restore')->name('case-types.restore');
    Route::delete('case-types/{case_type}/force-delete', 'CaseTypeController@forceDelete')->name('case-types.force.delete');
    Route::get('case-types/trashed', 'CaseTypeController@trashed')->name('case-types.trashed');
    Route::resource('case-types', 'CaseTypeController')->except(['create','show','edit']);

    //start LawsuitCaseController
    Route::post('lawsuit-cases/{lawsuit_case}/restore', 'LawsuitCaseController@restore')->name('lawsuit-cases.restore');
    Route::delete('lawsuit-cases/{lawsuit_case}/force-delete', 'LawsuitCaseController@forceDelete')->name('lawsuit-cases.force.delete');
    Route::get('lawsuit-cases/trashed', 'LawsuitCaseController@trashed')->name('lawsuit-cases.trashed');
    Route::resource('lawsuit-cases', 'LawsuitCaseController')->except(['create','show','edit']);

    //start CourtController
    Route::post('courts/{court}/restore', 'CourtController@restore')->name('courts.restore');
    Route::delete('courts/{court}/force-delete', 'CourtController@forceDelete')->name('courts.force.delete');
    Route::get('courts/trashed', 'CourtController@trashed')->name('courts.trashed');
    Route::resource('courts', 'CourtController')->except(['create','show','edit']);

    //start CaseStageController
    Route::post('case-stages/{case_stage}/restore', 'CaseStageController@restore')->name('case-stages.restore');
    Route::delete('case-stages/{case_stage}/force-delete', 'CaseStageController@forceDelete')->name('case-stages.force.delete');
    Route::get('case-stages/trashed', 'CaseStageController@trashed')->name('case-stages.trashed');
    Route::resource('case-stages', 'CaseStageController')->except(['create','show','edit']);

    //start LawsuiteController
    Route::resource('lawsuites', 'LawsuiteController');
    Route::get('lawsuites-status/{id}', 'LawsuiteController@lawsuitesStatus')->name('lawsuites.status');
    Route::get('lawsuites/contract/{id}', 'LawsuiteController@showContract')->name('show.contract');
    Route::match(['put','patch'],'lawsuites/judgment-update/{lawsuite}', 'LawsuiteController@judgmentUpdate')->name('lawsuites.judgment.update');

    //start LawsuiteNumberController
    Route::resource('lawsuites-number', 'LawsuiteNumberController')->except(['index','create','edit','show']);

    //start LawsuitePaperController
    Route::resource('lawsuites-papers', 'LawsuitePaperController')->except(['create','edit']);

    //start CaseSessionController
    Route::resource('case-sessions', 'CaseSessionController')->except(['create']);

    //start ReceiptController
    Route::resource('receipts', 'ReceiptController')->except(['create','show','edit']);
    Route::get('receipts/show_file/{id}', 'ReceiptController@showReceipt')->name('show.receipt');

    //start DocumentController
    Route::resource('documents', 'DocumentController')->except(['create','edit','update']);
    Route::get('download_document', 'DocumentController@downloadDocument')->name('download.document');;

    //start ConsultationController
    Route::resource('consultations', 'ConsultationController');
    Route::get('consultations/contract/{id}', 'ConsultationController@showContract')->name('show.consultation.contract');

    //start ReportsController
    Route::get('sessions-reports', 'ReportsController@sessionsReports')->name('sessions.reports');
    Route::get('lawsuites-reports', 'ReportsController@lawsuitesReports')->name('lawsuites.reports');
    Route::get('clients-reports', 'ReportsController@clientsReports')->name('clients.reports');
    Route::get('lawsuites-payments-reports', 'ReportsController@lawsuitesPaymentsReports')->name('lawsuites.payments.reports');
    Route::get('consultations-payments-reports', 'ReportsController@consultationsPaymentsReports')->name('consultations.payments.reports');
    Route::get('payments-reports', 'ReportsController@paymentsReports')->name('payments.reports');

    //start BranchController
    Route::post('branches/{branch}/restore', 'BranchController@restore')->name('branches.restore');
    Route::delete('branches/{branch}/force-delete', 'BranchController@forceDelete')->name('branches.force.delete');
    Route::get('branches/trashed', 'BranchController@trashed')->name('branches.trashed');
    Route::resource('branches', 'BranchController')->except(['create','show','edit']);

    //start ExpenseSectionController
    Route::post('expense-sections/{expense_section}/restore', 'ExpenseSectionController@restore')->name('expense-sections.restore');
    Route::delete('expense-sections/{expense_section}/force-delete', 'ExpenseSectionController@forceDelete')->name('expense-sections.force.delete');
    Route::get('expense-sections/trashed', 'ExpenseSectionController@trashed')->name('expense-sections.trashed');
    Route::resource('expense-sections', 'ExpenseSectionController')->except(['create','show','edit']);

    //start PaymentController
    Route::resource('payments', 'PaymentController')->except(['create','show','edit']);
    Route::get('payments/receipt/{id}', 'PaymentController@showReceipt')->name('get.payment.receipt');

    //start SettingController
    Route::get('settings', 'SettingController@index')->name('settings.index');
    Route::match(['put', 'patch'],'settings', 'SettingController@update')->name('settings.update');

    Route::get('backup', 'BackupController@index')->name('backup.index');
    Route::put('backup/create', 'BackupController@create')->name('backup.store');
    Route::get('backup/download/', 'BackupController@download')->name('backup.download');
    Route::delete('backup/delete/', 'BackupController@delete')->name('backup.destroy');
});
