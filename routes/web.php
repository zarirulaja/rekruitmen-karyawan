<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\LamaranController;
use App\Http\Controllers\HRDController;

Route::get('/', function () {
    return view('landing');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/signup', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/signup', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Password Reset Routes
Route::get('/forgot-password', [AuthController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'reset'])->name('password.update');

// Pelamar Routes - Protected with auth middleware
Route::middleware(['auth', 'role:pelamar'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/lowongan', [LowonganController::class, 'index'])->name('lowongan');

    Route::get('/lamaran-saya', [LamaranController::class, 'index'])->name('lamaran-saya');
    Route::post('/lowongan/{id}/apply', [LamaranController::class, 'store'])->name('lowongan.apply');

    Route::get('/lowongan/{id}', [LowonganController::class, 'show'])->name('detail-lowongan');

    // Profil routes
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
    Route::post('/profil/update-alamat', [ProfilController::class, 'updateAlamat']);
    Route::post('/profil/update-skill', [ProfilController::class, 'updateSkill']);
    Route::post('/profil/update-pengalaman', [ProfilController::class, 'updatePengalaman']);
    Route::post('/profil/update-pendidikan', [ProfilController::class, 'updatePendidikan']);
    Route::post('/profil/upload-cv', [ProfilController::class, 'uploadCV']);
    Route::post('/profil/delete-cv', [ProfilController::class, 'deleteCV']);

    Route::get('/notifikasi', [App\Http\Controllers\NotificationController::class, 'index'])->name('notifikasi');
    Route::post('/notifikasi/{id}/read', [App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifikasi.read');
    Route::post('/notifikasi/read-all', [App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('notifikasi.read-all');
});

// HR Panel Routes - Protected with auth middleware
Route::middleware(['auth', 'role:hrd'])->prefix('hrd')->name('hrd.')->group(function () {
    Route::get('/dashboard', [HRDController::class, 'dashboard'])->name('dashboard');

    // Job Postings Management
    Route::get('/lowongan', [HRDController::class, 'lowongan'])->name('lowongan');
    Route::get('/lowongan/create', [HRDController::class, 'createLowongan'])->name('lowongan.create');
    Route::post('/lowongan', [HRDController::class, 'storeLowongan'])->name('lowongan.store');
    Route::get('/lowongan/{id}', [HRDController::class, 'showLowongan'])->name('lowongan.show');
    Route::get('/lowongan/{id}/edit', [HRDController::class, 'editLowongan'])->name('lowongan.edit');
    Route::put('/lowongan/{id}', [HRDController::class, 'updateLowongan'])->name('lowongan.update');
    Route::delete('/lowongan/{id}', [HRDController::class, 'destroyLowongan'])->name('lowongan.destroy');
    
    Route::get('/pelamar', [HRDController::class, 'pelamar'])->name('pelamar');
    Route::get('/wawancara', [HRDController::class, 'wawancara'])->name('wawancara');
    
    // Application Management Routes
    Route::post('/lamaran/{id}/review', [HRDController::class, 'reviewLamaran'])->name('lamaran.review');
    Route::post('/lamaran/{id}/schedule-interview', [HRDController::class, 'scheduleInterview'])->name('lamaran.schedule-interview');
    Route::get('/pelamar/{id}', [HRDController::class, 'showPelamar'])->name('pelamar.show');
    Route::get('/pelamar/{id}/cv', [HRDController::class, 'downloadCV'])->name('pelamar.download-cv');
    Route::put('/lamaran/{id}/status', [HRDController::class, 'updateLamaranStatus'])->name('lamaran.update-status');
});
