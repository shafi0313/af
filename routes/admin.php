<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\ApplicantController;
use App\Http\Controllers\Admin\PatientYearlyFundRequestController;

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

Route::resource('patient-fund-request', PatientYearlyFundRequestController::class, ['parameters' => ['patient-fund-request' => 'patient_fund_request']]);
