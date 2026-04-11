<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\ReservationController;

use App\Http\Controllers\Manager\ManagerDashboardController;
use App\Http\Controllers\Manager\SportsCenterController;
use App\Http\Controllers\Manager\FieldController as ManagerFieldController;
use App\Http\Controllers\Manager\FieldScheduleController;
use App\Http\Controllers\Manager\ReservationController as ManagerReservationController;

Route::get('/', function () {
    return view('home');
});

Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/fields', [FieldController::class, 'index'])->name('fields.index');
Route::get('/fields/{id}', [FieldController::class, 'show'])->name('fields.show');

Route::middleware('check.auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('/my-reservations', [ReservationController::class, 'myReservations'])->name('reservations.my');
    Route::post('/reservations/{id}/cancel', [ReservationController::class, 'cancel'])->name('reservations.cancel');
});


Route::middleware(['check.auth', 'check.role:manager'])->prefix('manager')->name('manager.')->group(function () {
    Route::get('/dashboard', [ManagerDashboardController::class, 'index'])->name('dashboard');

    Route::get('/center', [SportsCenterController::class, 'index'])->name('center.index');
    Route::get('/center/create', [SportsCenterController::class, 'create'])->name('center.create');
    Route::post('/center/store', [SportsCenterController::class, 'store'])->name('center.store');
    Route::get('/center/{id}/edit', [SportsCenterController::class, 'edit'])->name('center.edit');
    Route::post('/center/{id}/update', [SportsCenterController::class, 'update'])->name('center.update');

    Route::get('/fields', [ManagerFieldController::class, 'index'])->name('fields.index');
    Route::get('/fields/create', [ManagerFieldController::class, 'create'])->name('fields.create');
    Route::post('/fields/store', [ManagerFieldController::class, 'store'])->name('fields.store');
    Route::get('/fields/{id}/edit', [ManagerFieldController::class, 'edit'])->name('fields.edit');
    Route::post('/fields/{id}/update', [ManagerFieldController::class, 'update'])->name('fields.update');
    Route::post('/fields/{id}/delete', [ManagerFieldController::class, 'destroy'])->name('fields.delete');

    Route::get('/fields/{fieldId}/schedules', [FieldScheduleController::class, 'index'])->name('schedules.index');
    Route::post('/fields/{fieldId}/schedules/store', [FieldScheduleController::class, 'store'])->name('schedules.store');
    Route::post('/schedules/{id}/delete', [FieldScheduleController::class, 'destroy'])->name('schedules.delete');

    Route::get('/reservations', [ManagerReservationController::class, 'index'])->name('reservations.index');
});