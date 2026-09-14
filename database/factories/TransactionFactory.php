<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Package;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Transaction>
 */
class TransactionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'event_id' => Event::factory(),
            'package_id' => Package::factory(),
            'invoice' => 'INV-' . now()->format('Ymd') . '-' . fake()->unique()->numerify('####'),
            'customer_name' => fake()->name(),
        ];
    }

    /**
     * Buat transaksi untuk event tertentu, dengan package
     * yang diambil dari package yang memang terdaftar di event itu.
     */
    public function forEvent(Event $event): static
    {
        return $this->state(function () use ($event) {
            $package = $event->packages()->inRandomOrder()->first();

            return [
                'event_id' => $event->id,
                'package_id' => $package->id,
            ];
        });
    }
}
