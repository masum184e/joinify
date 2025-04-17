<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function() {
    return view('login');
});

Route::get('/clubs/{id}', function() {
    return view('club');
});

Route::get('/clubs', function() {
    return view('clubs');
});

Route::get('/events/{id}', function() {
    return view('event');
});

Route::get('/join-club', function() {
    return view('join-club');
});

// Route::get('dashboard', function() {
//     return view('advisor/dashboard');
// });

Route::get('dashboard/create-club', function() {
    return view('advisor/create-club');
});

// Route::get('dashboard/edit-club/{id}', function() {
//     return view('advisor/edit-club');
// });

// Route::get('dashboard/clubs/{id}', function() {
//     return view('advisor/club');
// });

Route::get('dashboard/manage-clubs', function() {
    return view('advisor/manage-clubs');
});

// Route::get('dashboard', function() {
//     return view('accountant/dashboard');
// });

// Route::get('dashboard/manage-membership', function() {
//     return view('accountant/manage-membership');
// });

// Route::get('dashboard/', function() {
//     return view('secretary/dashboard');
// });

// Route::get('dashboard/create-event', function() {
//     return view('secretary/create-event');
// });

// Route::get('dashboard/edit-event/{id}', function() {
//     return view('secretary/edit-event');
// });

Route::get('dashboard/manage-events', function() {
    return view('secretary/manage-events');
});

Route::get('dashboard', function() {
    return view('president/dashboard');
});

Route::get('dashboard/manage-membership', function() {
    return view('accountant/manage-membership');
});