<?php

use App\Models\Event;
use Flux\Flux;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {
    use \Livewire\WithPagination;

    public $sortBy = 'created_at';
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
            wire:click="sort('created_at')">Status</flux:table.column>

        <flux:table.column sortable :sorted="$sortBy === 'created_at'" :direction="$sortDirection"
            wire:click="sort('created_at')">Dibuat Pada</flux:table.column>

        <flux:table.column></flux:table.column>
    </flux:table.columns>

    <flux:table.rows>
        @forelse ($this->events as $event)
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
                <div class="flex flex-col gap-1 text-xs">
                    <div class="flex items-center gap-1.5 font-medium text-zinc-800 dark:text-zinc-200">
                        <flux:icon icon="calendar" class="size-3.5 text-zinc-400" />
                        <span>{{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}</span>
                    </div>
                    @if ($event->location)
                    <div class="flex items-center gap-1.5 text-zinc-500 dark:text-zinc-400">
                        <flux:icon icon="map-pin" class="size-3.5 text-zinc-400" />
                        <span class="truncate max-w-45">{{ $event->location }}</span>
                    </div>
                    @else
                    <span class="text-zinc-400 dark:text-zinc-600 pl-5">-</span>
                    @endif
                </div>
            </flux:table.cell>

            {{-- Status --}}
            <flux:table.cell class="whitespace-nowrap text-xs text-zinc-500 dark:text-zinc-400">
                <livewire:event.active-switch-event :event="$event" />
            </flux:table.cell>

            {{-- Tanggal Dibuat --}}
            <flux:table.cell class="whitespace-nowrap text-xs text-zinc-500 dark:text-zinc-400">
                {{ $event->created_at?->format('d M Y, H:i') }}
            </flux:table.cell>

            {{-- Action Menu --}}
            <flux:table.cell>
                <div class="flex items-center justify-end gap-2">
                    {{-- Detail Event Button --}}
                    <flux:button href="{{ route('event.show', $event) }}" wire:navigate icon="magnifying-glass"
                        size="sm" variant="primary" color="sky" class="text-xs cursor-pointer">
                        Detail
                    </flux:button>

                    {{-- Edit Modal Trigger --}}
                    <livewire:event.edit-event :event="$event" :key="'edit-event-' . $event->id" />

                    {{-- Delete Button --}}
                    <livewire:event.delete-event :event="$event" :key="'delete-event-' . $event->id" />
                </div>
            </flux:table.cell>
        </flux:table.row>
        @empty
        {{-- Empty State Tampilan Saat Data Kosong --}}
        <flux:table.row>
            <flux:table.cell colspan="4" class="py-12 text-center">
                <div class="flex flex-col items-center justify-center gap-3">
                    <div class="p-3 rounded-full bg-zinc-100 dark:bg-zinc-800/80 text-zinc-400 dark:text-zinc-500">
                        <flux:icon icon="calendar-days" class="size-8 stroke-1.5" />
                    </div>
                    <div class="space-y-1">
                        <p class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">Belum Ada Event</p>
                        <p class="text-xs text-zinc-500 dark:text-zinc-400 max-w-sm mx-auto">
                            Belum ada acara photo booth yang terdaftar. <br>
                            Klik tombol <b>New Event</b> untuk membuat event baru.
                        </p>
                    </div>
                </div>
            </flux:table.cell>
        </flux:table.row>
        @endforelse
    </flux:table.rows>
</flux:table>