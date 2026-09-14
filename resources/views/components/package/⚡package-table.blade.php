<?php

use App\Models\Event;
use App\Models\Package;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {
    use \Livewire\WithPagination;

    public Event $event;

    public $sortBy = 'created_at';
    public $sortDirection = 'desc';

    #[On('package-updated')]
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
    public function packages()
    {
        return $this->event->packages()
            ->tap(fn($query) => $this->sortBy ? $query->orderBy($this->sortBy, $this->sortDirection) : $query)
            ->paginate(5);
    }
};
?>

<flux:table :paginate="$this->packages">
    <flux:table.columns>
        <flux:table.column sortable :sorted="$sortBy === 'name'" :direction="$sortDirection"
            wire:click="sort('name')">Nama Paket</flux:table.column>

        <flux:table.column>Harga</flux:table.column>

        <flux:table.column sortable :sorted="$sortBy === 'created_at'" :direction="$sortDirection"
            wire:click="sort('created_at')">Dibuat Pada</flux:table.column>

        <flux:table.column align="end">Aksi</flux:table.column>
    </flux:table.columns>

    <flux:table.rows>
        @forelse ($this->packages as $package)
        <flux:table.row :key="$package->id">
            {{-- Nama & Deskripsi Paket --}}
            <flux:table.cell>
                <div class="flex flex-col">
                    <span class="font-medium text-zinc-900 dark:text-zinc-100">{{ $package->name }}</span>
                    @if ($package->desc)
                    <span class="text-xs text-zinc-500 dark:text-zinc-400 line-clamp-1 max-w-sm"
                        title="{{ $package->desc }}">
                        {{ $package->desc }}
                    </span>
                    @endif
                </div>
            </flux:table.cell>

            {{-- Harga Paket --}}
            <flux:table.cell class="whitespace-nowrap font-medium text-emerald-600 dark:text-emerald-400">
                {{ $package->price ? 'Rp ' . number_format($package->price, 0, ',', '.') : '-' }}
            </flux:table.cell>

            {{-- Tanggal Dibuat --}}
            <flux:table.cell class="whitespace-nowrap text-xs text-zinc-500 dark:text-zinc-400">
                {{ $package->created_at?->format('d M Y, H:i') }}
            </flux:table.cell>

            {{-- Action Menu --}}
            <flux:table.cell>
                <div class="flex items-center justify-end gap-2">
                    {{-- Trigger Edit & Delete Paket --}}
                    <livewire:package.edit-package :package="$package" :key="'edit-package-' . $package->id" />
                    {{-- <livewire:package.delete-package :package="$package" :key="'delete-package-' . $package->id" /> --}}
                    <livewire:package.dettach-package-from-event :event="$event" :package="$package"
                        :key="'dettach-package-' . $package->id" />
                </div>
            </flux:table.cell>
        </flux:table.row>
        @empty
        {{-- Empty State Tampilan Saat Data Paket Kosong --}}
        <flux:table.row>
            <flux:table.cell colspan="3" class="py-10 text-center">
                <div class="flex flex-col items-center justify-center gap-2.5">
                    <div
                        class="p-2.5 rounded-full bg-zinc-100 dark:bg-zinc-800/80 text-zinc-400 dark:text-zinc-500">
                        <flux:icon icon="gift" class="size-7 stroke-1.5" />
                    </div>
                    <div class="space-y-0.5">
                        <p class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">Belum Ada Paket Layanan
                        </p>
                        <p class="text-xs text-zinc-500 dark:text-zinc-400 max-w-xs mx-auto">
                            Belum ada daftar paket photo booth yang terdaftar di sistem.
                        </p>
                    </div>
                </div>
            </flux:table.cell>
        </flux:table.row>
        @endforelse
    </flux:table.rows>
</flux:table>