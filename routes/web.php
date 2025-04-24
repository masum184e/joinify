<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SslCommerzPaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', fn() => view('welcome'));

Route::get('/login', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

// Route::get('/members/{id}', fn() => view('member'));

//     Route::get('/dashboard/members', fn() => view('dashboard.members'));
//     Route::get('/dashboard/members/{id}', fn() => view('dashboard.member'));

//     Route::get('/dashboard/settings', fn() => view('dashboard.settings'));
// });

Route::prefix('clubs')->group(function () {
    Route::get('/', [ClubController::class, 'publicIndex']);
    Route::get('/{club}', [ClubController::class, 'publicShow']);
    Route::get('/{club}/join', [ClubController::class, 'joinClub']);
});

Route::prefix('clubs/{club}/events/')->group(function () {
    Route::get('/', [EventController::class, 'publicIndex']);
    Route::get('/{event}', [EventController::class, 'publicShow']);
});

Route::prefix('dashboard')->middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::resource('clubs', ClubController::class);
    Route::resource('/clubs/{club}/events', EventController::class);
    Route::get('/settings', fn() => view('dashboard.settings'));
});

Route::post('/pay/{club}', [SslCommerzPaymentController::class, 'index']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

// Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END
