<?php

use App\Models\Package;
use Flux\Flux;
use Livewire\Component;

new class extends Component {
    public string $name = '';
    public ?string $desc = null;
    public string $price = '';

    public function updatedPrice(string $value): void
    {
        // Bersihkan semua karakter selain angka
        $clean = preg_replace('/\D/', '', $value);

        if ($clean !== '') {
            // Format ribuan dengan titik (contoh: 10000 -> 10.000)
            $this->price = number_format((int) $clean, 0, ',', '.');
        } else {
            $this->price = '';
        }
    }

    public function save(): void
    {
        // Hilangkan titik pemisah ribuan sebelum validasi dan simpan ke DB
        $cleanPrice = $this->price !== '' ? (int) str_replace('.', '', $this->price) : null;

        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
        ]);

        $validated['price'] = $cleanPrice;

        Package::create($validated);

        $this->reset();

        $this->dispatch('package-updated');

        Flux::modal('create-package')->close();
        Flux::toast(variant: 'success', text: 'Paket berhasil dibuat.');
    }
};
?>

<div>
    {{-- Trigger Button --}}
    <flux:modal.trigger name="create-package">
        <flux:button variant="primary" color="sky" icon="plus" size="sm" class="cursor-pointer">
            Paket Baru
        </flux:button>
    </flux:modal.trigger>

    {{-- Modal Component --}}
    <flux:modal name="create-package" class="md:w-96 ">
        <div>
            <flux:heading size="lg">Tambah Paket Layanan</flux:heading>
            <flux:subheading>Buat paket baru untuk pilihan transaksi photo booth.</flux:subheading>
        </div>

        <form wire:submit="save" class="space-y-4">
            {{-- Input Nama Paket --}}
            <flux:input wire:model="name" label="Nama Paket" placeholder="Contoh: Paket High School (3 Frame)"
                required />

            {{-- Input Harga Paket --}}
            <div x-data="{
                format(el) {
                    let val = el.value.replace(/\D/g, '');
                    el.value = val ? new Intl.NumberFormat('id-ID').format(val) : '';
                }
            }">
                <flux:input
                    wire:model.live.debounce.300ms="price"
                    x-on:input="format($el)"
                    label="Harga Paket (Rp)"
                    placeholder="Contoh: 10.000"
                    inputmode="numeric"
                />
            </div>

            {{-- Input Deskripsi Paket --}}
            <flux:textarea wire:model="desc" label="Deskripsi"
                placeholder="Keterangan singkat isi atau fasilitas paket..." rows="3" />

            {{-- Modal Actions --}}
            <div class="flex items-center justify-end gap-2 pt-2">
                <flux:modal.close>
                    <flux:button variant="ghost">Batal</flux:button>
                </flux:modal.close>

                <flux:button type="submit" variant="primary" wire:loading.attr="disabled">
                    <span wire:loading.remove wire:target="save">Simpan Paket</span>
                    <span wire:loading wire:target="save">Menyimpan...</span>
                </flux:button>
            </div>
        </form>
    </flux:modal>
</div>
