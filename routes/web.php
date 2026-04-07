<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\DashboardController;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{service:slug}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/emergency', [ServiceController::class, 'emergency'])->name('services.emergency');
Route::get('/sitemap.xml', [\App\Http\Controllers\SitemapController::class, 'index'])->name('sitemap');
Route::get('/language/{lang}', [\App\Http\Controllers\LanguageController::class, 'switch'])->name('language.switch');

// Auth required
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Reviews
    Route::post('/reviews', [\App\Http\Controllers\ReviewController::class, 'store'])->name('reviews.store');

    // Provider routes
    Route::middleware('role:provider|admin')->group(function () {
        Route::get('/post-service', [ServiceController::class, 'create'])->name('services.create');
        Route::post('/post-service', [ServiceController::class, 'store'])->name('services.store');
        Route::get('/my-services', [ServiceController::class, 'myServices'])->name('services.my');
        Route::get('/services/{service}/edit', [ServiceController::class, 'edit'])->name('services.edit');
        Route::put('/services/{service}', [ServiceController::class, 'update'])->name('services.update');
        Route::delete('/services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');
        Route::get('/profile', [\App\Http\Controllers\ProfilePageController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [\App\Http\Controllers\ProfilePageController::class, 'update'])->name('profile.update');
        Route::post('/testimonials', [\App\Http\Controllers\TestimonialController::class, 'store'])->name('testimonials.store');
    });
});


// Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('index');
    Route::post('/services/{service}/approve', [\App\Http\Controllers\Admin\AdminController::class, 'approve'])->name('services.approve');
    Route::post('/services/{service}/reject', [\App\Http\Controllers\Admin\AdminController::class, 'reject'])->name('services.reject');
    Route::post('/services/{service}/feature', [\App\Http\Controllers\Admin\AdminController::class, 'feature'])->name('services.feature');
    Route::post('/services/{service}/verify', [\App\Http\Controllers\Admin\AdminController::class, 'verify'])->name('services.verify');
    Route::post('/testimonials/{testimonial}/approve', [\App\Http\Controllers\Admin\AdminController::class, 'approveTestimonial'])->name('testimonials.approve');
    Route::delete('/testimonials/{testimonial}', [\App\Http\Controllers\Admin\AdminController::class, 'deleteTestimonial'])->name('testimonials.delete');
});
require __DIR__ . '/auth.php';
