<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FarmController;
use App\Http\Controllers\LivestockController;
use App\Http\Controllers\HealthRecordController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Farmer\DashboardController as FarmerDashboardController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-image', function () {
    return view('test-image');
});

Route::get('/check-image', function () {
    $path = 'livestock/IO9KRJYJZ76R1RFAg8jitniX55QzDluS6Xzm1kzj.jpg';
    $fullPath = storage_path('app/public/' . $path);
    $publicPath = public_path('storage/' . $path);

    return [
        'storage_exists' => file_exists($fullPath),
        'public_exists' => file_exists($publicPath),
        'storage_path' => $fullPath,
        'public_path' => $publicPath,
        'asset_url' => asset('storage/' . $path)
    ];
});

// Auth routes (Breeze provides these in auth.php, but we're adding the dashboard redirect)
Route::middleware(['auth'])->group(function () {
    // Common dashboard - redirects based on role
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);

    // Settings routes
    Route::get('/settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::get('/settings/{group}', [App\Http\Controllers\Admin\SettingController::class, 'group'])->name('settings.group');
    Route::post('/settings/{group}', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
});

// Farmer routes
Route::middleware(['auth', 'role:farmer'])->prefix('farmer')->name('farmer.')->group(function () {
    // Farm management
    Route::resource('farms', FarmController::class);

    // Livestock management
    Route::resource('livestock', LivestockController::class);

    // Health records management
    Route::resource('health-records', HealthRecordController::class);

    // Farmer dashboard
    Route::get('/dashboard', [FarmerDashboardController::class, 'index'])->name('dashboard');
});

require __DIR__.'/auth.php';
