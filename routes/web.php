<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyProfileController;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

// Auth routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

// Protected routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Articles
    Route::resource('articles', ArticleController::class);
    
    // Categories
    Route::resource('categories', CategoryController::class)->except(['show']);
    
    // Company Profile
    Route::get('/company-profile', [CompanyProfileController::class, 'index'])->name('company-profile.index');
    Route::get('/company-profile/edit', [CompanyProfileController::class, 'edit'])->name('company-profile.edit');
    Route::put('/company-profile', [CompanyProfileController::class, 'update'])->name('company-profile.update');
});