<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourierController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SMSController;
use App\Http\Controllers\TrackingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('landing');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::get('/track', [TrackingController::class, 'search'])->name('track.search');
Route::get('/track/{trackingNumber}', [TrackingController::class, 'view'])->name('track.view');
Route::get('/track/{trackingNumber}/print', [TrackingController::class, 'print'])->name('track.print');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::get('/my-shipments', [TrackingController::class, 'myShipments'])->name('customer.shipments');
});

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/statistics', [AdminController::class, 'statistics'])->name('admin.statistics');

    Route::get('/agents', [AdminController::class, 'index'])->name('admin.agents.index');
    Route::get('/agents/create', [AdminController::class, 'create'])->name('admin.agents.create');
    Route::post('/agents', [AdminController::class, 'store'])->name('admin.agents.store');
    Route::get('/agents/{id}', [AdminController::class, 'show'])->name('admin.agents.show');
    Route::get('/agents/{id}/edit', [AdminController::class, 'edit'])->name('admin.agents.edit');
    Route::put('/agents/{id}', [AdminController::class, 'update'])->name('admin.agents.update');
    Route::delete('/agents/{id}', [AdminController::class, 'destroy'])->name('admin.agents.destroy');

    Route::get('/customers', [AdminController::class, 'customers'])->name('admin.customers.index');
    Route::get('/customers/search', [AdminController::class, 'searchCustomer'])->name('admin.customers.search');
    Route::get('/customers/{id}', [AdminController::class, 'showCustomer'])->name('admin.customers.show');

    Route::get('/couriers', [CourierController::class, 'index'])->name('couriers.index');
    Route::get('/couriers/create', [CourierController::class, 'create'])->name('couriers.create');
    Route::post('/couriers', [CourierController::class, 'store'])->name('couriers.store');
    Route::get('/couriers/{id}', [CourierController::class, 'show'])->name('couriers.show');
    Route::get('/couriers/{id}/edit', [CourierController::class, 'edit'])->name('couriers.edit');
    Route::put('/couriers/{id}', [CourierController::class, 'update'])->name('couriers.update');
    Route::delete('/couriers/{id}', [CourierController::class, 'destroy'])->name('couriers.destroy');
    Route::post('/couriers/{id}/status', [CourierController::class, 'updateStatus'])->name('couriers.status');
    Route::post('/couriers/{id}/send-sms/from-to', [SMSController::class, 'sendFromToSMS'])->name('couriers.sms.from-to');
    Route::post('/couriers/{id}/send-sms/delivery', [SMSController::class, 'sendDeliverySMS'])->name('couriers.sms.delivery');

    Route::get('/reports', [ReportController::class, 'index'])->name('admin.reports.index');
    Route::get('/reports/create', [ReportController::class, 'create'])->name('admin.reports.create');
    Route::post('/reports', [ReportController::class, 'store'])->name('admin.reports.store');
    Route::get('/reports/{id}/download', [ReportController::class, 'download'])->name('admin.reports.download');
});

Route::prefix('agent')->middleware(['auth', 'role:agent'])->group(function () {
    Route::get('/dashboard', [AgentController::class, 'dashboard'])->name('agent.dashboard');
    Route::get('/statistics', [AgentController::class, 'statistics'])->name('agent.statistics');

    Route::get('/couriers', [CourierController::class, 'index'])->name('agent.couriers.index');
    Route::get('/couriers/create', [CourierController::class, 'create'])->name('agent.couriers.create');
    Route::post('/couriers', [CourierController::class, 'store'])->name('agent.couriers.store');
    Route::get('/couriers/{id}', [CourierController::class, 'show'])->name('agent.couriers.show');
    Route::get('/couriers/{id}/edit', [CourierController::class, 'edit'])->name('agent.couriers.edit');
    Route::put('/couriers/{id}', [CourierController::class, 'update'])->name('agent.couriers.update');
    Route::delete('/couriers/{id}', [CourierController::class, 'destroy'])->name('agent.couriers.destroy');
    Route::post('/couriers/{id}/status', [CourierController::class, 'updateStatus'])->name('agent.couriers.status');
    Route::post('/couriers/{id}/send-sms/from-to', [SMSController::class, 'sendFromToSMS'])->name('agent.couriers.sms.from-to');
    Route::post('/couriers/{id}/send-sms/delivery', [SMSController::class, 'sendDeliverySMS'])->name('agent.couriers.sms.delivery');

    Route::get('/reports', [ReportController::class, 'index'])->name('agent.reports.index');
    Route::get('/reports/create', [ReportController::class, 'create'])->name('agent.reports.create');
    Route::post('/reports', [ReportController::class, 'store'])->name('agent.reports.store');
    Route::get('/reports/{id}/download', [ReportController::class, 'download'])->name('agent.reports.download');
});
