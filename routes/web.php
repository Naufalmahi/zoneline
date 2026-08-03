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

// Tenant Public Subdomain Route
Route::domain('{tenant}.localhost')->group(function () {
    Route::get('/', [\App\Http\Controllers\TenantFrontController::class, 'index'])->name('tenant.home');
});

// Default Domain Route
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

// Superadmin Routes (no tenant needed)
Route::prefix('superadmin')->name('superadmin.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Superadmin\DashboardController::class, 'index'])->name('dashboard');
    
    // Tenants
    Route::get('/tenants', [\App\Http\Controllers\Superadmin\TenantController::class, 'index'])->name('tenants.index');
    Route::get('/tenants/create', [\App\Http\Controllers\Superadmin\TenantController::class, 'create'])->name('tenants.create');
    Route::post('/tenants', [\App\Http\Controllers\Superadmin\TenantController::class, 'store'])->name('tenants.store');
    
    // Billing
    Route::get('/billing', [\App\Http\Controllers\Superadmin\BillingController::class, 'index'])->name('billing.index');
});

// Owner Routes
Route::prefix('owner')->name('owner.')->middleware(['auth', 'tenant'])->group(function () {
    
    Route::get('/dashboard', [\App\Http\Controllers\Owner\DashboardController::class, 'index'])->name('dashboard');

    // Orders
    Route::get('/orders', [\App\Http\Controllers\Owner\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/create', [\App\Http\Controllers\Owner\OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [\App\Http\Controllers\Owner\OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}', [\App\Http\Controllers\Owner\OrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/status', [\App\Http\Controllers\Owner\OrderController::class, 'updateStatus'])->name('orders.update-status');

    // Customers (Full CRUD)
    Route::get('/customers', [\App\Http\Controllers\Owner\CustomerController::class, 'index'])->name('customers.index');
    Route::get('/customers/create', [\App\Http\Controllers\Owner\CustomerController::class, 'create'])->name('customers.create');
    Route::post('/customers', [\App\Http\Controllers\Owner\CustomerController::class, 'store'])->name('customers.store');
    Route::get('/customers/{customer}', [\App\Http\Controllers\Owner\CustomerController::class, 'show'])->name('customers.show');
    Route::get('/customers/{customer}/edit', [\App\Http\Controllers\Owner\CustomerController::class, 'edit'])->name('customers.edit');
    Route::put('/customers/{customer}', [\App\Http\Controllers\Owner\CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/customers/{customer}', [\App\Http\Controllers\Owner\CustomerController::class, 'destroy'])->name('customers.destroy');

    // Services
    Route::get('/services', [\App\Http\Controllers\Owner\ServiceController::class, 'index'])->name('services.index');
    Route::get('/services/create', [\App\Http\Controllers\Owner\ServiceController::class, 'create'])->name('services.create');
    Route::post('/services', [\App\Http\Controllers\Owner\ServiceController::class, 'store'])->name('services.store');
    Route::get('/services/{service}/edit', [\App\Http\Controllers\Owner\ServiceController::class, 'edit'])->name('services.edit');
    Route::put('/services/{service}', [\App\Http\Controllers\Owner\ServiceController::class, 'update'])->name('services.update');
    Route::delete('/services/{service}', [\App\Http\Controllers\Owner\ServiceController::class, 'destroy'])->name('services.destroy');
    Route::get('/reports', [\App\Http\Controllers\Owner\ReportController::class, 'index'])->name('reports.index');
    Route::get('/payments', function () { return view('owner.dashboard', ['title' => 'Pembayaran']); })->name('payments.index');
    Route::get('/employees', function () { return view('owner.dashboard', ['title' => 'Karyawan']); })->name('employees.index');
    Route::get('/settings', [\App\Http\Controllers\Owner\SettingsController::class, 'index'])->name('settings.index');
    Route::put('/settings', [\App\Http\Controllers\Owner\SettingsController::class, 'update'])->name('settings.update');
    
    // New Routes for Coffee & Barbershop
    Route::get('/menus', function () { return view('owner.dashboard', ['title' => 'Menu']); })->name('menus.index');
    Route::get('/tables', function () { return view('owner.dashboard', ['title' => 'Meja']); })->name('tables.index');
    Route::get('/reservations', function () { return view('owner.dashboard', ['title' => 'Reservasi']); })->name('reservations.index');
    Route::get('/bookings', function () { return view('owner.dashboard', ['title' => 'Booking']); })->name('bookings.index');
    Route::get('/barbers', function () { return view('owner.dashboard', ['title' => 'Jadwal Barber']); })->name('barbers.index');
    
    // Custom Role Management (CRUD)
    Route::get('/roles', [\App\Http\Controllers\Owner\RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/create', [\App\Http\Controllers\Owner\RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles', [\App\Http\Controllers\Owner\RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/{role}/edit', [\App\Http\Controllers\Owner\RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/{role}', [\App\Http\Controllers\Owner\RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/{role}', [\App\Http\Controllers\Owner\RoleController::class, 'destroy'])->name('roles.destroy');
});
