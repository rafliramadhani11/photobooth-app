<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Package;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat 4 paket fix (Basic, Standard, Premium, Deluxe)
        $packages = Package::factory()->count(4)->create();

        // 2. Buat 10 event
        $events = Event::factory()->count(10)->create();

        // 3. Tiap event dikaitkan ke 1-3 package random lewat pivot event_package
        $events->each(function (Event $event) use ($packages) {
            $event->packages()->attach(
                $packages->random(rand(1, 3))->pluck('id')->toArray()
            );
        });

        // 4. Buat 30 transaksi, tiap transaksi pilih event random,
        //    lalu package-nya diambil dari package yang memang terdaftar di event itu
        $events->each(function (Event $event) {
            Transaction::factory()
                ->count(rand(2, 5))
                ->forEvent($event)
                ->create();
        });
    }
}
