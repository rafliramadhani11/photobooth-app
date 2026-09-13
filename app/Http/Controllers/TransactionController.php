<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Package;
use App\Models\Transaction;
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
        $this->createTransaction($request, $event, $package);

        $payload = $this->createPayload($request, $event, $package);

        $dokuResponse = $this->dokuService->createCheckout($payload);

        $paymentUrl = $dokuResponse['response']['payment']['url'] ?? null;

        return Inertia::flash('paymentUrl', $paymentUrl)->back();
    }

    protected function createPayload(Request $request, Event $event, Package $package): array
    {
        return  [
            'order' => [
                'amount' => (int) $package->price,
                'invoice_number' => 'PB-' . date('HisYmd') . '-' . rand(100, 999),
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
    }

    protected function createTransaction(Request $request, Event $event, Package $package): Transaction
    {
        return Transaction::create([
            'event_id' => $event->id,
            'package_id' => $package->id,
            'invoice' => 'PB-' . date('HisYmd') . '-' . rand(100, 999),
            'customer_name' => $request->customer_name,
        ]);
    }
}
