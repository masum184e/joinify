<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('welcome'));
Route::get('/login', fn() => view('login'));
Route::post('/login', [AuthController::class, 'login'])->name('login');


Route::get('/clubs', fn() => view('clubs'));
Route::get('/clubs/{id}', fn() => view('club'));
Route::get('/clubs/{id}/join', fn() => view('join-club'));

Route::get('/events/{id}', fn() => view('event'));

Route::get('/members/{id}', fn() => view('member'));

Route::get('/dashboard', fn() => view('dashboard.advisor'));
Route::get('/dashboard/president', fn() => view('dashboard.president'));
Route::get('/dashboard/secretary', fn() => view('dashboard.secretary'));
Route::get('/dashboard/accountant', fn() => view('dashboard.accountant'));

Route::get('/dashboard/clubs/create', fn() => view('dashboard.club-form', ["page" => "create"]));
Route::get('/dashboard/clubs', fn() => view('dashboard.clubs'));
Route::get('/dashboard/clubs/{id}', fn() => view('dashboard.club'));
Route::get('/dashboard/clubs/{id}/edit', fn() => view('dashboard.club-form', ["page" => "edit"]));

Route::get('/dashboard/events/create', fn() => view('dashboard.event-form', ["page" => "create"]));
Route::get('/dashboard/events', fn() => view('dashboard.events'));
Route::get('/dashboard/events/{id}', fn() => view('dashboard.event'));
Route::get('/dashboard/events/{id}/edit', fn() => view('dashboard.event-form', ["page" => "edit"]));

Route::get('/dashboard/members', fn() => view('dashboard.members'));
Route::get('/dashboard/members/{id}', fn() => view('dashboard.member'));

Route::get('/dashboard/settings', fn() => view('dashboard.settings'));