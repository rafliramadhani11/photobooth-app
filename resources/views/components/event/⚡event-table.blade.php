<?php

use App\Models\Event;
use Flux\Flux;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {
    use \Livewire\WithPagination;

    public $sortBy = 'date';
    public $sortDirection = 'desc';

    #[On('event-updated')]
    public function refreshTable()
    {
        //
    }

    public function sort(string $column)
    {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
    }

    public function toggleStatus(int $eventId)
    {
        $event = Event::findOrFail($eventId);

        $event->is_active = !$event->is_active;
        $event->save();

        $statusText = $event->is_active ? 'diaktifkan' : 'dinonaktifkan';

        Flux::toast(variant: 'success', text: "Event \"{$event->name}\" berhasil {$statusText}.");
    }

    #[Computed]
    public function events()
    {
        return Event::query()->tap(fn($query) => $this->sortBy ? $query->orderBy($this->sortBy, $this->sortDirection) : $query)->orderBy('created_at', 'desc')->paginate(5);
    }
};
?>

<flux:table :paginate="$this->events">
    <flux:table.columns>
        <flux:table.column sortable :sorted="$sortBy === 'name'" :direction="$sortDirection"
            wire:click="sort('name')">Nama Event</flux:table.column>

        <flux:table.column sortable :sorted="$sortBy === 'event_date'" :direction="$sortDirection"
            wire:click="sort('event_date')">Tanggal & Lokasi</flux:table.column>

        <flux:table.column sortable :sorted="$sortBy === 'is_active'" :direction="$sortDirection"
            wire:click="sort('is_active')">Status</flux:table.column>

        <flux:table.column sortable :sorted="$sortBy === 'created_at'" :direction="$sortDirection"
            wire:click="sort('created_at')">Dibuat Pada</flux:table.column>

        <flux:table.column align="end"></flux:table.column>
    </flux:table.columns>

    <flux:table.rows>
        @foreach ($this->events as $event)
            <flux:table.row :key="$event->id">
                {{-- Nama & Deskripsi --}}
                <flux:table.cell>
                    <div class="flex flex-col">
                        <span class="font-medium text-zinc-900 dark:text-zinc-100">{{ $event->name }}</span>
                        @if ($event->desc)
                            <span class="text-xs text-zinc-500 dark:text-zinc-400 line-clamp-1 max-w-xs"
                                title="{{ $event->desc }}">
                                {{ $event->desc }}
                            </span>
                        @endif
                    </div>
                </flux:table.cell>

                {{-- Tanggal & Lokasi --}}
                <flux:table.cell>
                    <div class="flex flex-col text-xs">
                        <span class="font-medium text-zinc-800 dark:text-zinc-200">
                            {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}
                        </span>
                        <span class="text-zinc-500 dark:text-zinc-400">
                            {{ $event->location ?? '-' }}
                        </span>
                    </div>
                </flux:table.cell>

                {{-- Status Badge --}}
                <flux:table.cell class="gap-x-3 flex items-center">
                    {{-- Switch dengan animasi & proteksi disabled saat loading --}}
                    <flux:switch accent="emerald" :checked="$event->is_active"
                        wire:change="toggleStatus({{ $event->id }})" wire:loading.attr="disabled"
                        wire:target="toggleStatus({{ $event->id }})"
                        class="wire-loading:opacity-50 cursor-pointer disabled:cursor-not-allowed" />

                    {{-- Badge Normal (Sembunyi saat loading) --}}
                    <flux:badge wire:loading.remove wire:target="toggleStatus({{ $event->id }})" size="sm"
                        inset="top bottom" :color="$event->is_active ? 'emerald' : 'zinc'">
                        {{ $event->is_active ? 'Aktif' : 'Nonaktif' }}
                    </flux:badge>

                    {{-- Badge Loading (Muncul hanya saat request toggleStatus berjalan) --}}
                    <flux:icon wire:loading wire:target="toggleStatus({{ $event->id }})" icon="arrow-path"
                        class="size-4 animate-spin" />
                </flux:table.cell>

                {{-- Tanggal Dibuat --}}
                <flux:table.cell class="text-xs text-zinc-500 dark:text-zinc-400">
                    {{ $event->created_at?->format('d M Y, H:i') }}
                </flux:table.cell>

                {{-- Action Menu --}}
                <flux:table.cell>
                    <div class="flex items-center justify-end gap-3" wire:loading.attr="disabled">
                        {{-- Edit Modal Trigger --}}
                        <livewire:event.edit-event :event="$event" :key="'edit-event-' . $event->id" />

                        {{-- Delete Button --}}
                        <livewire:event.delete-event :event="$event" :key="'delete-event-' . $event->id" />
                    </div>
                </flux:table.cell>
            </flux:table.row>
        @endforeach
    </flux:table.rows>
</flux:table>
