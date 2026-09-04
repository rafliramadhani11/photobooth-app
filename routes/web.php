<?php

use Illuminate\Support\Facades\Route;

Route::inertia('/', 'welcome')->name('home');

// AUTH ------------------------------------------------------------------------------------
Route::middleware(['guest'])->group(function () {
    Route::view('/login', 'pages.auth.login')->name('login');
    Route::view('/register', 'pages.auth.register')->name('register');
});

// APP ------------------------------------------------------------------------------------
Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('events', 'pages.app.event.index')->name('event.index');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'pages.dashboard')->name('dashboard');
});

require __DIR__ . '/settings.php';
