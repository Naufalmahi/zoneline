<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Owner\OrderController;
use App\Http\Controllers\TrackingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/track', [TrackingController::class, 'index'])->name('track.index');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Owner Routes
Route::prefix('owner')->name('owner.')->middleware(['auth', 'tenant'])->group(function () {
    
    Route::get('/dashboard', function () {
        return view('owner.dashboard', ['title' => 'Dashboard']);
    })->name('dashboard');

    Route::get('/orders', function () {
        return view('owner.dashboard', ['title' => 'Semua Order']); 
    })->name('orders.index');

    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

    Route::get('/customers', function () {
        return view('owner.dashboard', ['title' => 'Manajemen Pelanggan']); 
    })->name('customers.index');

    Route::get('/services', function () {
        return view('owner.dashboard', ['title' => 'Layanan']); 
    })->name('services.index');

    Route::get('/payments', function () {
        return view('owner.dashboard', ['title' => 'Pembayaran']); 
    })->name('payments.index');

    Route::get('/reports', function () {
        return view('owner.dashboard', ['title' => 'Laporan']); 
    })->name('reports.index');

    Route::get('/employees', function () {
        return view('owner.dashboard', ['title' => 'Karyawan']); 
    })->name('employees.index');

    Route::get('/settings', function () {
        return view('owner.dashboard', ['title' => 'Pengaturan']); 
    })->name('settings.index');
});
