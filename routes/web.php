<?php

require __DIR__.'/auth.php';

use App\Http\Controllers\OnboardingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EnergyEventController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

#Default Route / is Login
Route::get('/', function () {
    return view('auth.login');
})->name('login');

#Dashboard Route
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'initialized'])->name('dashboard');

#Middleware Route
#Middleware Route
Route::middleware(['auth', 'initialized'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/buy', [\App\Http\Controllers\BuyController::class, 'index'])->name('buy');
    Route::post('/buy', [\App\Http\Controllers\BuyController::class, 'store'])->name('buy.store');
    Route::get('/zones', [\App\Http\Controllers\ZoneController::class, 'index'])->name('zones');
    Route::get('/est-pat', [\App\Http\Controllers\EstPatController::class, 'index'])->name('est-pat');
    Route::post('/energy/report', [EnergyEventController::class, 'store'])->name('energy.report');
});

#Onboarding Route
Route::middleware('auth')->group(function () {

    Route::get('/onboarding', [OnboardingController::class, 'show'])
        ->name('onboarding');

    Route::post('/onboarding', [OnboardingController::class, 'store'])
        ->name('onboarding.store');
});

#Stewards View
Route::middleware(['auth', 'initialized', 'steward'])->group(function () {

    Route::get('/steward/dashboard', [\App\Http\Controllers\StewardController::class, 'index'])->name('steward.dashboard');
    Route::get('/steward/stats', [\App\Http\Controllers\StewardController::class, 'stats'])->name('steward.stats');
    Route::get('/steward/users', [\App\Http\Controllers\StewardController::class, 'users'])->name('steward.users');
    Route::get('/steward/zones', [\App\Http\Controllers\StewardController::class, 'zones'])->name('steward.zones');
    Route::get('/steward/validation', [\App\Http\Controllers\StewardController::class, 'validation'])->name('steward.validation');

    // Admin User Creation
    Route::get('/admin/users/create', [\App\Http\Controllers\AdminUserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [\App\Http\Controllers\AdminUserController::class, 'store'])->name('admin.users.store');

    // Energy Event Validation
    Route::post('/energy/validate', \App\Http\Controllers\EnergyEventValidationController::class)->name('energy.validate');

    // Gift Token
    Route::post('/steward/gift-token', [\App\Http\Controllers\StewardController::class, 'giftToken'])->name('steward.gift-token');

});


#require __DIR__.'/auth.php';
