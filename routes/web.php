<?php

use App\Http\Controllers\ClubController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SslCommerzPaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', fn() => view('welcome'));

// Login routes
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

// Public routes
// Route::get('/clubs', [ClubController::class, 'pubic_index'])->name('clubs.pubic_index');
// Route::get('/clubs/{id}', [ClubController::class, 'public_show'])->name('clubs.public_show');
// Route::get('/events/{id}', [EventController::class, 'public_show'])->name('events.public_show');
// Route::get('/members/{id}', fn() => view('member'));

// // Protected routes (require login)
// Route::middleware('auth')->group(function () {
//     Route::get('/dashboard', fn() => view('dashboard.advisor'));
//     Route::get('/dashboard/president', fn() => view('dashboard.president'));
//     Route::get('/dashboard/secretary', fn() => view('dashboard.secretary'));
//     Route::get('/dashboard/accountant', fn() => view('dashboard.accountant'));

//     // // Route::resource('/dashboard/clubs', ClubController::class)->only(['index','store', 'update', 'show']);
//     // Route::get('/dashboard/clubs/create', fn() => view('dashboard.club-form', ["page" => "create"]))->name('clubs.store');
//     // Route::post('/dashboard/clubs/create', [ClubController::class, 'store'])->name('clubs.store');
//     // Route::get('/dashboard/clubs', [ClubController::class, 'index'])->name('clubs.index');
//     // Route::get('/dashboard/clubs/{id}', [ClubController::class, 'show'])->name('clubs.show');
//     // // Route::get('/dashboard/clubs/{id}', fn() => view('dashboard.club'));
//     // Route::get('/dashboard/clubs/{id}/edit', fn() => view('dashboard.club-form', ["page" => "edit"]));

//     Route::get('/dashboard/events/create', fn() => view('dashboard.event-form', ["page" => "create"]));
//     Route::post('/dashboard/events/create', [EventController::class, 'store'])->name('events.store');
//     Route::get('/dashboard/events', [EventController::class, 'index'])->name('events.index');
//     Route::get('/dashboard/events/{id}', [EventController::class, 'show'])->name('events.show');
//     Route::get('/dashboard/events/{id}/edit', fn() => view('dashboard.event-form', ["page" => "edit"]));

//     Route::get('/dashboard/members', fn() => view('dashboard.members'));
//     Route::get('/dashboard/members/{id}', fn() => view('dashboard.member'));

//     Route::get('/dashboard/settings', fn() => view('dashboard.settings'));
// });

// Route::get('/dashboard/clubs/create', fn() => view('dashboard.club-form', ["page" => "create"]));

Route::prefix('clubs')->group(function () {
    Route::get('/', [ClubController::class, 'publicIndex']);
    Route::get('/{club}', [ClubController::class, 'publicShow']);
    Route::get('/{club}/join', [ClubController::class, 'joinClub']);
});

// Route::middleware(['auth'])->group(function () {
//     Route::prefix('/dashboard/clubs')->group(function () {
//         Route::get('/', [ClubController::class, 'index']);
//         Route::get('/create', [ClubController::class, 'create']);
//         Route::get('/{club}', [ClubController::class, 'show']);
//         Route::delete('/{club}', [ClubController::class, 'destroy']);
//         Route::post('/', [ClubController::class, 'store']);
//         Route::get('/{club}/edit', [ClubController::class, 'edit']);
//         Route::put('/{club}', [ClubController::class, 'update']);
//     });
// });
Route::prefix('dashboard')->middleware(['auth'])->group(function () {
    Route::resource('clubs', ClubController::class);
    // Route::resource('clubs/{club}/events', EventController::class);

    // Route::get('clubs/{club}/events/create', [EventController::class, 'create']);
    // Route::get('clubs/{club}/events/', [EventController::class, 'index']);

    Route::prefix('/clubs/{club}/events')->group(function () {
        Route::get('/', [EventController::class, 'index']);
        Route::get('/create', [EventController::class, 'create']);
        Route::get('/{event}', [EventController::class, 'show']);
        // Route::delete('/{club}', [EventController::class, 'destroy']);
        Route::post('/', [EventController::class, 'store']);
        // Route::get('/{club}/edit', [EventController::class, 'edit']);
        // Route::put('/{club}', [EventController::class, 'update']);
    });
});


// SSLCOMMERZ Start
// Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
// Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay/{club}', [SslCommerzPaymentController::class, 'index']);
// Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END
