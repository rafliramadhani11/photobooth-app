<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Package;
use Illuminate\Http\Request;
use Livewire\Attributes\Computed;
use App\Services\DokuService;
use Inertia\Inertia;

class TransactionController extends Controller
{
    protected DokuService $dokuService;

    public function __construct(DokuService $dokuService)
    {
        $this->dokuService = $dokuService;
    }

    public function store(Request $request, Event $event, Package $package)
    {
        $invoice = 'PB-' . date('HisYmd') . '-' . rand(100, 999);

        $payload = [
            'order' => [
                'amount' => (int) $package->price,
                'invoice_number' => $invoice,
                'currency' => 'IDR',
                'callback_url' => url('/'),
                'line_items' => [
                    [
                        'name' => "{$event->name} - {$package->name}",
                        'price' => (int) $package->price,
                        'quantity' => 1,
                    ]
                ]
            ],
            'payment' => [
                'payment_due_date' => 30,
            ],
            'customer' => [
                'name' => $request->customer_name,
            ]
        ];

        $dokuResponse = $this->dokuService->createCheckout($payload);

        $paymentUrl = $dokuResponse['response']['payment']['url'] ?? null;

        return Inertia::flash('paymentUrl', $paymentUrl)->back();
    }
}
