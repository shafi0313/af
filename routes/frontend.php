<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\PatientController;
use App\Http\Controllers\Frontend\ApplicantController;

Route::resource('/applicant', ApplicantController::class)->only(['store']);
Route::get('/getDistrict', [ApplicantController::class, 'getDistrict'])->name('getDistrict');
Route::get('/getUpazila', [ApplicantController::class, 'getUpazila'])->name('getUpazila');
Route::get('/getUnion', [ApplicantController::class, 'getUnion'])->name('getUnion');

Route::resource('/patient', PatientController::class)->only(['store']);
