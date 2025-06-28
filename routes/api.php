<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProjectApiController;
use App\Http\Controllers\API\BiodataApiController;

// API RESTful LENGKAP UNTUK PROJECT
Route::apiResource('projects', ProjectApiController::class);
Route::apiResource('biodata', BiodataApiController::class);

Route::get('/biodata/utama', [BiodataApiController::class, 'utama']);
