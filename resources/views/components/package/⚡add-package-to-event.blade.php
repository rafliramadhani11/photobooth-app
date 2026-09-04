<?php

use App\Models\Event;
use App\Models\Package;
use Flux\Flux;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component {
    public Event $event;
    public ?string $package_id = null;

    // Mengambil daftar paket master yang belum ditambahkan ke event ini
    #[Computed]
    public function availablePackages()
    {
        return Package::whereDoesntHave('events', function ($query) {
            $query->where('events.id', $this->event->id);
        })->get();
    }

    public function attach(): void
    {
        $this->validate(
            [
                'package_id' => ['required', 'exists:packages,id', Rule::unique('event_package', 'package_id')->where('event_id', $this->event->id)],
            ],
            [
                'package_id.required' => 'Silakan pilih paket terlebih dahulu.',
                'package_id.unique' => 'Paket ini sudah ditambahkan ke event ini.',
            ],
        );

        // Hubungkan paket ke event via pivot table
        $this->event->packages()->attach($this->package_id);

        $this->reset('package_id');

        // Refresh tabel paket di event.show
        $this->dispatch('package-updated');

        Flux::modal('add-package-to-event')->close();
        Flux::toast(variant: 'success', text: 'Paket berhasil ditambahkan ke event ini.');
    }
};
?>

<div>
    {{-- Trigger Button --}}
    <flux:modal.trigger name="add-package-to-event">
        <flux:button variant="primary" icon="link" size="sm" class="cursor-pointer">
            Kaitkan Paket
        </flux:button>
    </flux:modal.trigger>

    {{-- Modal Component --}}
    <flux:modal name="add-package-to-event" class="md:w-96 space-y-6">
        <div>
            <flux:heading size="lg">Tambah Paket ke Event</flux:heading>
            <flux:subheading>Pilih paket layanan yang tersedia untuk event ini.</flux:subheading>
        </div>

        <form wire:submit="attach" class="space-y-4">
            {{-- Dropdown Searchable Paket --}}
            <flux:select wire:model="package_id" label="Pilih Paket" placeholder="Cari atau pilih paket..." searchable>
                @forelse ($this->availablePackages as $package)
                    <flux:select.option :value="$package->id">
                        {{ $package->name }}
                    </flux:select.option>
                @empty
                    <flux:select.option value="" disabled>
                        Semua paket sudah ditambahkan
                    </flux:select.option>
                @endforelse
            </flux:select>

            {{-- Modal Actions --}}
            <div class="flex items-center justify-end gap-2 pt-2">
                <flux:modal.close>
                    <flux:button variant="ghost">Batal</flux:button>
                </flux:modal.close>

                <flux:button type="submit" variant="primary" wire:loading.attr="disabled"
                    :disabled="$this->availablePackages->isEmpty()">
                    <span wire:loading.remove wire:target="attach">Simpan</span>
                    <span wire:loading wire:target="attach">Menyimpan...</span>
                </flux:button>
            </div>
        </form>
    </flux:modal>
</div>
