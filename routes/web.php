<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TrainerController;

// Authentication
Route::get('', [Controller::class, 'index'])->name('home');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboard (all roles go through DashboardController@index)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Junior
    Route::middleware('role:junior')->group(function () {
        Route::post('/resume/upload', [ResumeController::class, 'upload'])->name('resume.upload');
    });

    // Senior
    Route::middleware('role:senior')->group(function () {
        Route::post('/resume/approve/{id}', [ResumeController::class, 'approve'])->name('resume.approve');
        Route::post('/resume/reject/{id}', [ResumeController::class, 'reject'])->name('resume.reject');
    });

    // Customer
    Route::middleware('role:customer')->group(function () {
        Route::post('/payment/{resume}', [PaymentController::class, 'pay'])->name('payment.pay');
    });

    // Accountant
    Route::middleware('role:accountant')->group(function () {
        // Accountant-specific routes
    });

    // Trainer
    Route::middleware('role:trainer')->group(function () {
        Route::post('/trainer/assign', [PaymentController::class, 'assignBatch'])->name('trainer.assign');
    });

    // Admin
    Route::middleware('role:admin')->group(function () {
        // Admin-specific routes
    });
});

Route::post('/resumes/upload/{id}', [ResumeController::class, 'upload'])->name('resumes.upload')->middleware('auth');
Route::patch('/resumes/{id}/status', [ResumeController::class, 'updateStatus'])->name('resumes.updateStatus');
Route::patch('/payment/{id}/status', [PaymentController::class, 'updateStatus'])->name('payment.updateStatus');
Route::patch('/training/{id}/status', [PaymentController::class, 'updateStatus'])->name('training.updateStatus');


