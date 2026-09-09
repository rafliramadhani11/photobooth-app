<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use App\Services\DokuService;

Route::get('/', [EventController::class, 'welcome'])
    ->name('home');
Route::post('/transaction/{event}/{package}/checkout', [TransactionController::class, 'store'])
    ->name('transaction.store');

Route::post('test-doku', function (DokuService $dokuService) {
    $invoiceNumber = 'PB-' . date('YmdHis') . '-' . rand(100, 999);
    $packageName = 'Paket Regular 3 Jam';
    $price = 50000;

    $payload = [
        'order' => [
            'amount' => $price,
            'invoice_number' => $invoiceNumber,
            'currency' => 'IDR',
            'callback_url' => url('/'),
            'line_items' => [
                [
                    'name' => "Sesi Photo Booth: {$packageName}",
                    'price' => $price,
                    'quantity' => 1,
                ]
            ]
        ],
        'payment' => [
            'payment_due_date' => 30, // Batas waktu bayar dalam menit
        ],
        'customer' => [
            'name' => 'Pelanggan Photo Booth',
            'email' => 'customer@photobooth.local',
        ]
    ];

    $response = $dokuService->createCheckout($payload);

    return response()->json($response);
});

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
