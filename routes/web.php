<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
// 1. Pastikan kedua controller web ini diimpor
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\WorkExperienceController;
use App\Http\Controllers\EducationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- HALAMAN PUBLIK ---
Route::get('/', function () {
    $biodata = \App\Models\Biodata::first();
    $projects = \App\Models\Project::latest()->get();
    $skills = \App\Models\Skill::all();
    $workExperiences = \App\Models\WorkExperience::all();
    $educations = \App\Models\Education::all();
    return view('welcome', compact('biodata', 'projects', 'skills', 'workExperiences', 'educations'));
});

// --- HALAMAN YANG DIAMANKAN (WAJIB LOGIN) ---
Route::middleware('auth')->group(function () {
    
    // Halaman utama setelah login
    Route::get('/dashboard', function () {
        return redirect()->route('projects.index');
    })->name('dashboard');

    // =======================================================
    // ======== PERBAIKAN UTAMA ADA DI DUA BARIS INI =========
    // =======================================================
    
    // 2. Mendaftarkan semua route CRUD untuk halaman manajemen Project
    Route::resource('projects', ProjectController::class);

    // 3. Mendaftarkan semua route CRUD untuk halaman manajemen Biodata
    Route::resource('biodatas', BiodataController::class)->except(['destroy', 'show']);

    // Route untuk profil pengguna bawaan Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('skills', SkillController::class);

    Route::resource('work-experiences', WorkExperienceController::class);
    Route::resource('educations', EducationController::class);


});

// Route untuk otentikasi (login, register, dll.)
require __DIR__.'/auth.php';
