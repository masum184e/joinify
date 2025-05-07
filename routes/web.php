<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\SslCommerzPaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout']);

Route::prefix('clubs')->group(function () {
    Route::get('/', [ClubController::class, 'publicIndex']);
    Route::get('/{club}', [ClubController::class, 'publicShow']);
    Route::get('/{club}/join', [ClubController::class, 'joinClub']);
});

Route::prefix('events')->group(function () {
    Route::get('/', [EventController::class, 'publicIndex']);
    Route::get('/{club}', [EventController::class, 'publicShow']);
});

Route::prefix('clubs/{club}/events/')->group(function () {
    Route::get('/', [EventController::class, 'publicIndexForClub']);
    Route::get('/{event}', [EventController::class, 'publicShowForClub']);
});

Route::prefix('dashboard')->middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::resource('clubs', ClubController::class);
    Route::resource('/clubs/{club}/events', EventController::class);

    Route::get('/clubs/{club}/members', [MemberController::class, 'index']);
    Route::get('/clubs/{club}/members/{member}', [MemberController::class, 'show']);

    Route::get('/settings', fn() => view('dashboard.settings'));
});

Route::post('/pay/{club}', [SslCommerzPaymentController::class, 'index']);

Route::match(['get', 'post'], '/success', [SslCommerzPaymentController::class, 'success'])->name('payment.success');
Route::match(['get', 'post'], '/fail', [SslCommerzPaymentController::class, 'fail'])->name('payment.fail');
Route::match(['get', 'post'], '/cancel', [SslCommerzPaymentController::class, 'cancel'])->name('payment.cancel');
Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn'])->name('payment.ipn');
