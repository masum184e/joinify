<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function() {
    return view('login');
});

Route::get('dashboard', function() {
    return view('dashboard/dashboard');
});

Route::get('dashboard/create-club', function() {
    return view('dashboard/create-club');
});

Route::get('dashboard/edit-club/{id}', function() {
    return view('dashboard/edit-club');
});

Route::get('dashboard/manage-clubs', function() {
    return view('dashboard/manage-clubs');
});