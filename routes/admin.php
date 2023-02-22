<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\ApplicantController;


Route::resource('/applicant', ApplicantController::class);

// Route::get('/getDistrict', [ApplicantController::class, 'getDistrict'])->name('getDistrict');
// Route::get('/getUpazila', [ApplicantController::class, 'getUpazila'])->name('getUpazila');
// Route::get('/getUnion', [ApplicantController::class, 'getUnion'])->name('getUnion');

Route::resource('/patient', PatientController::class);