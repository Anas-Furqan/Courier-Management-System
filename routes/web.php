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

Route::prefix('admin')->middleware(['auth', 'role:admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/statistics', [AdminController::class, 'statistics'])->name('statistics');

    Route::get('/agents', [AdminController::class, 'index'])->name('agents.index');
    Route::get('/agents/create', [AdminController::class, 'create'])->name('agents.create');
    Route::post('/agents', [AdminController::class, 'store'])->name('agents.store');
    Route::get('/agents/{id}', [AdminController::class, 'show'])->name('agents.show');
    Route::get('/agents/{id}/edit', [AdminController::class, 'edit'])->name('agents.edit');
    Route::put('/agents/{id}', [AdminController::class, 'update'])->name('agents.update');
    Route::delete('/agents/{id}', [AdminController::class, 'destroy'])->name('agents.destroy');

    Route::get('/customers', [AdminController::class, 'customers'])->name('customers.index');
    Route::get('/customers/search', [AdminController::class, 'searchCustomer'])->name('customers.search');
    Route::get('/customers/{id}', [AdminController::class, 'showCustomer'])->name('customers.show');

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

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/create', [ReportController::class, 'create'])->name('reports.create');
    Route::post('/reports', [ReportController::class, 'store'])->name('reports.store');
    Route::get('/reports/{id}/download', [ReportController::class, 'download'])->name('reports.download');
});

Route::prefix('agent')->middleware(['auth', 'role:agent'])->name('agent.')->group(function () {
    Route::get('/dashboard', [AgentController::class, 'dashboard'])->name('dashboard');
    Route::get('/statistics', [AgentController::class, 'statistics'])->name('statistics');

    Route::get('/couriers', [AgentController::class, 'index'])->name('couriers.index');
    Route::get('/couriers/create', [AgentController::class, 'create'])->name('couriers.create');
    Route::post('/couriers', [AgentController::class, 'store'])->name('couriers.store');
    Route::get('/couriers/{id}', [AgentController::class, 'show'])->name('couriers.show');
    Route::get('/couriers/{id}/edit', [AgentController::class, 'edit'])->name('couriers.edit');
    Route::put('/couriers/{id}', [AgentController::class, 'update'])->name('couriers.update');
    Route::delete('/couriers/{id}', [AgentController::class, 'destroy'])->name('couriers.destroy');
    Route::post('/couriers/{id}/status', [CourierController::class, 'updateStatus'])->name('couriers.status');
    Route::post('/couriers/{id}/send-sms/from-to', [SMSController::class, 'sendFromToSMS'])->name('couriers.sms.from-to');
    Route::post('/couriers/{id}/send-sms/delivery', [SMSController::class, 'sendDeliverySMS'])->name('couriers.sms.delivery');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/create', [ReportController::class, 'create'])->name('reports.create');
    Route::post('/reports', [ReportController::class, 'store'])->name('reports.store');
    Route::get('/reports/{id}/download', [ReportController::class, 'download'])->name('reports.download');
});
