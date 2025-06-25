<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProjectApiController;
use App\Http\Controllers\API\BiodataApiController;

// API RESTful LENGKAP UNTUK PROJECT
Route::apiResource('projects', ProjectApiController::class);

// API UNTUK BIODATA
Route::get('/biodata', [BiodataApiController::class, 'index']);
Route::post('/biodata', [BiodataApiController::class, 'store']);