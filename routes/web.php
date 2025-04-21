<?php

use App\Http\Controllers\ClubController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', fn() => view('welcome'));

// Login routes
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

// Public routes
Route::get('/clubs', [ClubController::class, 'pubic_index'])->name('clubs.pubic_index');
Route::get('/clubs/{id}', [ClubController::class, 'public_show'])->name('clubs.public_show');
Route::get('/clubs/{id}/join', fn() => view('join-club'));
Route::get('/events/{id}', [EventController::class, 'public_show'])->name('events.public_show');
Route::get('/members/{id}', fn() => view('member'));

// Protected routes (require login)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn() => view('dashboard.advisor'));
    Route::get('/dashboard/president', fn() => view('dashboard.president'));
    Route::get('/dashboard/secretary', fn() => view('dashboard.secretary'));
    Route::get('/dashboard/accountant', fn() => view('dashboard.accountant'));

    // Route::resource('/dashboard/clubs', ClubController::class)->only(['index','store', 'update', 'show']);
    Route::get('/dashboard/clubs/create', fn() => view('dashboard.club-form', ["page" => "create"]))->name('clubs.store');
    Route::post('/dashboard/clubs/create', [ClubController::class, 'store'])->name('clubs.store');
    Route::get('/dashboard/clubs', [ClubController::class, 'index'])->name('clubs.index');
    Route::get('/dashboard/clubs/{id}', [ClubController::class, 'show'])->name('clubs.show');
    // Route::get('/dashboard/clubs/{id}', fn() => view('dashboard.club'));
    Route::get('/dashboard/clubs/{id}/edit', fn() => view('dashboard.club-form', ["page" => "edit"]));

    Route::get('/dashboard/events/create', fn() => view('dashboard.event-form', ["page" => "create"]));
    Route::post('/dashboard/events/create', [EventController::class, 'store'])->name('events.store');
    Route::get('/dashboard/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/dashboard/events/{id}', [EventController::class, 'show'])->name('events.show');
    Route::get('/dashboard/events/{id}/edit', fn() => view('dashboard.event-form', ["page" => "edit"]));

    Route::get('/dashboard/members', fn() => view('dashboard.members'));
    Route::get('/dashboard/members/{id}', fn() => view('dashboard.member'));

    Route::get('/dashboard/settings', fn() => view('dashboard.settings'));
});
