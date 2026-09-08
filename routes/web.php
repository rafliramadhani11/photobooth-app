<?php

use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Route;
use Xendit\Configuration;
use Xendit\Invoice\InvoiceApi;
use Xendit\PaymentMethod\PaymentMethodApi;

Route::inertia('/', 'welcome')->name('home');

Route::post('/', [TransactionController::class, 'store'])->name('transaction.store');

// AUTH ------------------------------------------------------------------------------------
Route::middleware(['guest'])->group(function () {
    Route::view('/login', 'pages.auth.login')->name('login');
    Route::view('/register', 'pages.auth.register')->name('register');
});

// APP ------------------------------------------------------------------------------------
Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('events', 'pages.app.event.index')->name('event.index');
    Route::livewire('events/{event:id}/detail', 'pages::app.event.show')->name('event.show');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'pages.dashboard')->name('dashboard');
});

require __DIR__ . '/settings.php';
