<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/health-check', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now()->toISOString(),
    ]);
})->name('health-check');

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('dashboard', [DashboardController::class, 'store'])->name('dashboard.store');
    
    // Placeholder routes for menu actions
    Route::get('transactions', function () {
        return Inertia::render('dashboard');
    })->name('transactions.index');
    
    Route::get('products', function () {
        return Inertia::render('dashboard');
    })->name('products.index');
    
    Route::get('payments', function () {
        return Inertia::render('dashboard');
    })->name('payments.index');
    
    Route::get('transfers', function () {
        return Inertia::render('dashboard');
    })->name('transfers.index');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
