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

Route::get('dashboard', function() {
    return view('advisor/dashboard');
});

Route::get('dashboard/create-club', function() {
    return view('advisor/create-club');
});

Route::get('dashboard/edit-club/{id}', function() {
    return view('advisor/edit-club');
});

Route::get('dashboard/clubs/{id}', function() {
    return view('advisor/club');
});

Route::get('dashboard/manage-clubs', function() {
    return view('advisor/manage-clubs');
});