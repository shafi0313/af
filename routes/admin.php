<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MissionController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\CashBookController;
use App\Http\Controllers\Admin\ApplicantController;
use App\Http\Controllers\Admin\PeriodLockController;
use App\Http\Controllers\Admin\FundRequetionController;
use App\Http\Controllers\Admin\CashBookReportController;
use App\Http\Controllers\Admin\PatientFundRequestController;
use App\Http\Controllers\Admin\PatientFundApprovalController;
use App\Http\Controllers\Admin\StudentFundRequetionController;
use App\Http\Controllers\Admin\PatientPaymentApprovalController;
use App\Http\Controllers\Admin\RequestPaymentApprovalController;

Route::get('/period-lock', [PeriodLockController::class, 'index'])->name('period_lock.index');
Route::post('/period-lock', [PeriodLockController::class, 'update'])->name('period_lock.update');

Route::resource('missions', MissionController::class);
Route::resource('applicant', ApplicantController::class);
Route::post('applicant/accept', [ApplicantController::class, 'accept'])->name('applicant.accept');
Route::post('applicant/reject', [ApplicantController::class, 'reject'])->name('applicant.reject');

// Route::get('/getDistrict', [ApplicantController::class, 'getDistrict'])->name('getDistrict');
// Route::get('/getUpazila', [ApplicantController::class, 'getUpazila'])->name('getUpazila');
// Route::get('/getUnion', [ApplicantController::class, 'getUnion'])->name('getUnion');

Route::resource('patient', PatientController::class);
Route::delete('patient/delete/{medicine_id}', [PatientController::class, 'delete'])->name('patient.medicine.delete');
Route::post('/patient/accept', [PatientController::class, 'accept'])->name('patient.accept');
Route::post('/patient/reject', [PatientController::class, 'reject'])->name('patient.reject');

Route::resource('patient-fund-request', PatientFundRequestController::class, ['parameters' => ['patient-fund-request' => 'patient_fund_request']]);
Route::get('/getMedicines', [PatientFundRequestController::class, 'getMedicines'])->name('patient_fund_request.getMedicines');

Route::resource('patient-fund-approval', PatientFundApprovalController::class, ['parameters' => ['patient-fund-approval' => 'patient_fund_approval']]);

Route::resource('/patient-fund-requetion', FundRequetionController::class, ['parameters' => ['patient-fund-requetion' => 'patient_fund_requetion']]);
Route::resource('/student-fund-requetion', StudentFundRequetionController::class, ['parameters' => ['student-fund-requetion' => 'student_fund_requetion']]);
Route::resource('/patient-payment-approval', PatientPaymentApprovalController::class, ['parameters' => ['patient-payment-approval' => 'patient_payment_approval']]);
Route::post('/patient-payment-approval/accept', [PatientPaymentApprovalController::class, 'accept'])->name('patient_payment_approval.accept');

Route::controller(CashBookController::class)->prefix('cash-book')->name('cash_book.')->group(function () {
    Route::get('/office', 'office')->name('office');
    Route::post('/office/store', 'officeStore')->name('officeStore');
    Route::get('/entry/{office}', 'entry')->name('entry');
    Route::post('/entry', 'store')->name('store');
    Route::post('/post', 'post')->name('post');
    Route::get('/destroy/{id}', 'destroy')->name('destroy');
    Route::get('/note', 'noteStore')->name('note_store');
    Route::get('/getBalance', 'getBalance')->name('get_balance');
    Route::get('/getReceiptDate', 'getReceiptDate')->name('get_receipt_date');
});
Route::controller(CashBookReportController::class)->prefix('cash-book-report')->name('cash_book_report.')->group(function () {
    Route::get('/select', 'select')->name('select');
    Route::get('/report', 'report')->name('report');
});

Route::resource('request-payment-approval', RequestPaymentApprovalController::class);
Route::get('/request-payment-approval/student-approved/{id}', [RequestPaymentApprovalController::class, 'studentApproved'])->name('r_p_a.student_approved');
