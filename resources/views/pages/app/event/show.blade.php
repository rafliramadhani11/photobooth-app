<?php

use App\Models\Event;
use Livewire\Attributes\Layout;
use Livewire\Component;

new class extends Component {
    public Event $event;

    public function mount(Event $event)
    {
        $this->event = $event;
    }

    public function render()
    {
        return $this->view()
            ->layout('layouts::app')
            ->title('Detail Event ' . $this->event->name);
    }
};
?>


<div class="space-y-6">
    {{-- Header Section --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            {{-- Dynamic Breadcrumbs --}}
            <flux:breadcrumbs class="mb-2">
                <flux:breadcrumbs.item href="{{ route('dashboard') }}" icon="home" />
                <flux:breadcrumbs.item href="{{ route('event.index') }}" wire:navigate>{{ __('Events') }}
                </flux:breadcrumbs.item>
                <flux:breadcrumbs.item>{{ $event->name }}</flux:breadcrumbs.item>
            </flux:breadcrumbs>

            {{-- Title & Status --}}
            <div class="flex items-center gap-3">
                <flux:heading size="xl" level="1">{{ $event->name }}</flux:heading>
                <flux:badge size="sm" :color="$event->is_active ? 'emerald' : 'zinc'">
                    {{ $event->is_active ? 'Aktif' : 'Nonaktif' }}
                </flux:badge>
            </div>
            <flux:subheading size="lg" class="mt-1">
                Detail informasi operasional dan sesi photo booth acara ini.
            </flux:subheading>
        </div>

        {{-- Actions --}}
        <div class="flex items-center gap-2">
            <flux:button href="{{ route('event.index') }}" wire:navigate icon="arrow-left" variant="ghost">
                Kembali
            </flux:button>
            <livewire:event.edit-event :event="$event" :key="'edit-event-' . $event->id" />
        </div>
    </div>

    <flux:separator variant="subtle" />

    {{-- Overview Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        {{-- Tanggal Event --}}
        <flux:card class="p-4 flex items-center gap-4">
            <div class="p-3 rounded-xl bg-sky-50 dark:bg-sky-950/50 text-sky-600 dark:text-sky-400">
                <flux:icon icon="calendar" class="size-6" />
            </div>
            <div>
                <p class="text-xs font-medium text-zinc-500 dark:text-zinc-400">Tanggal Pelaksanaan</p>
                <p class="text-base font-semibold text-zinc-900 dark:text-white">
                    {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}
                </p>
            </div>
        </flux:card>

        {{-- Lokasi Event --}}
        <flux:card class="p-4 flex items-center gap-4">
            <div class="p-3 rounded-xl bg-emerald-50 dark:bg-emerald-950/50 text-emerald-600 dark:text-emerald-400">
                <flux:icon icon="map-pin" class="size-6" />
            </div>
            <div>
                <p class="text-xs font-medium text-zinc-500 dark:text-zinc-400">Lokasi / Venue</p>
                <p class="text-base font-semibold text-zinc-900 dark:text-white truncate max-w-50">
                    {{ $event->location ?? 'Belum Diatur' }}
                </p>
            </div>
        </flux:card>

        {{-- Tanggal Dibuat --}}
        <flux:card class="p-4 flex items-center gap-4">
            <div class="p-3 rounded-xl bg-purple-50 dark:bg-purple-950/50 text-purple-600 dark:text-purple-400">
                <flux:icon icon="clock" class="size-6" />
            </div>
            <div>
                <p class="text-xs font-medium text-zinc-500 dark:text-zinc-400">Dibuat Pada</p>
                <p class="text-base font-semibold text-zinc-900 dark:text-white">
                    {{ $event->created_at?->format('d M Y, H:i') }}
                </p>
            </div>
        </flux:card>
    </div>

    {{-- Main Content Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Left Column: Detail Info & Quick Status --}}
        <div class="lg:col-span-1 space-y-6">
            <livewire:event.detail-event :event="$event" :key="'detail-event-' . $event->id" />
        </div>

        {{-- Right Column: Placeholders for Package & Customer Data --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Package Section Placeholder --}}
            <flux:card class="space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <flux:heading size="lg">Paket Layanan</flux:heading>
                        <flux:subheading>Daftar paket photo booth yang tersedia.</flux:subheading>
                    </div>

                    {{-- Tombol Tambah Paket (jika ada) --}}
                    <div class="flex justify-between gap-x-3">
                        <livewire:package.add-package-to-event :event="$event" />
                        <livewire:package.create-package />
                    </div>
                </div>

                <flux:separator variant="subtle" />

                {{-- Panggilan Komponen Tabel Paket --}}
                <div>
                    <livewire:package.package-table :event="$event" />
                </div>
            </flux:card>

            {{-- Customer / Transaction Section Placeholder --}}
            <flux:card class="space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <flux:heading size="lg">Data Customer & Transaksi</flux:heading>
                        <flux:subheading>Riwayat pembayaran customer
                        </flux:subheading>
                    </div>
                </div>

                <flux:separator variant="subtle" />

                <livewire:transaction.transaction-table />
            </flux:card>
        </div>
    </div>
</div>
