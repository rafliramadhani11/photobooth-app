<?php

use App\Models\Transaction;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {
    use \Livewire\WithPagination;

    public $sortBy = 'created_at';
    public $sortDirection = 'desc';

    #[On('transaction-updated')]
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
    public function transactions()
    {
        return Transaction::query()
            ->with(['event', 'package'])
            ->tap(fn($query) => $this->sortBy ? $query->orderBy($this->sortBy, $this->sortDirection) : $query)
            ->orderBy('created_at', 'desc')
            ->paginate(5);
    }
};
?>

<flux:table :paginate="$this->transactions">
    <flux:table.columns>
        <flux:table.column sortable :sorted="$sortBy === 'invoice'" :direction="$sortDirection"
            wire:click="sort('invoice')">Invoice</flux:table.column>

        <flux:table.column sortable :sorted="$sortBy === 'customer_name'" :direction="$sortDirection"
            wire:click="sort('customer_name')">Customer</flux:table.column>

        <flux:table.column>Paket</flux:table.column>

        <flux:table.column sortable :sorted="$sortBy === 'created_at'" :direction="$sortDirection"
            wire:click="sort('created_at')">Dibuat Pada</flux:table.column>

        <flux:table.column align="end">Aksi</flux:table.column>
    </flux:table.columns>

    <flux:table.rows>
        @forelse ($this->transactions as $transaction)
            <flux:table.row :key="$transaction->id">
                {{-- Invoice Number --}}
                <flux:table.cell>
                    <div class="flex items-center gap-2">
                        <div class="p-1.5 rounded-lg bg-sky-50 dark:bg-sky-950/50 text-sky-600 dark:text-sky-400">
                            <flux:icon icon="document-text" class="size-4" />
                        </div>
                        <span class="font-mono font-medium text-sm text-zinc-900 dark:text-zinc-100">
                            {{ $transaction->invoice }}
                        </span>
                    </div>
                </flux:table.cell>

                {{-- Customer Name --}}
                <flux:table.cell>
                    <div class="flex items-center gap-2.5">
                        <div
                            class="flex items-center justify-center size-8 rounded-full bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 text-xs font-semibold uppercase">
                            {{ Str::substr($transaction->customer_name, 0, 2) }}
                        </div>
                        <span class="font-medium text-zinc-900 dark:text-zinc-100">
                            {{ $transaction->customer_name }}
                        </span>
                    </div>
                </flux:table.cell>

                {{-- Package Name --}}
                <flux:table.cell>
                    @if ($transaction->package)
                        <flux:badge size="sm" color="purple" variant="pill">
                            {{ $transaction->package->name }}
                        </flux:badge>
                    @else
                        <span class="text-xs text-zinc-400 dark:text-zinc-600">-</span>
                    @endif
                </flux:table.cell>

                {{-- Created At --}}
                <flux:table.cell class="whitespace-nowrap text-xs text-zinc-500 dark:text-zinc-400">
                    <div class="flex flex-col gap-0.5">
                        <span class="font-medium text-zinc-700 dark:text-zinc-300">
                            {{ $transaction->created_at?->format('d M Y') }}
                        </span>
                        <span class="text-zinc-400 dark:text-zinc-500">
                            {{ $transaction->created_at?->format('H:i') }} WIB
                        </span>
                    </div>
                </flux:table.cell>

                {{-- Actions --}}
                <flux:table.cell>
                    <div class="flex items-center justify-end gap-2">
                        <flux:button icon="eye" size="sm" variant="ghost" tooltip="Lihat Detail"
                            class="cursor-pointer" />
                        <flux:button icon="trash" size="sm" variant="ghost" color="red"
                            tooltip="Hapus Transaksi" class="cursor-pointer" />
                    </div>
                </flux:table.cell>
            </flux:table.row>
        @empty
            {{-- Empty State --}}
            <flux:table.row>
                <flux:table.cell colspan="5" class="py-12 text-center">
                    <div class="flex flex-col items-center justify-center gap-3">
                        <div class="p-3 rounded-full bg-zinc-100 dark:bg-zinc-800/80 text-zinc-400 dark:text-zinc-500">
                            <flux:icon icon="receipt-percent" class="size-8 stroke-1.5" />
                        </div>
                        <div class="space-y-1">
                            <p class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">Belum Ada Transaksi</p>
                            <p class="text-xs text-zinc-500 dark:text-zinc-400 max-w-sm mx-auto">
                                Belum ada riwayat transaksi customer yang tercatat. <br>
                                Transaksi akan muncul saat customer melakukan pembayaran.
                            </p>
                        </div>
                    </div>
                </flux:table.cell>
            </flux:table.row>
        @endforelse
    </flux:table.rows>
</flux:table>
