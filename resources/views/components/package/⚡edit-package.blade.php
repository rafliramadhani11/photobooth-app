<?php

use App\Models\Package;
use Flux\Flux;
use Livewire\Component;

new class extends Component {
    public Package $package;

    public string $name = '';
    public ?string $desc = null;

    public function mount(): void
    {
        $this->name = $this->package->name;
        $this->desc = $this->package->desc;
    }

    public function update(): void
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
        ]);

        $this->package->update($validated);

        Flux::modal('edit-package-' . $this->package->id)->close();
        Flux::toast(variant: 'success', text: 'Paket berhasil diperbarui.');

        $this->dispatch('package-updated');
    }
};
?>

<div>
    {{-- Trigger Button Icon --}}
    <flux:modal.trigger :name="'edit-package-' . $package->id">
        <flux:button icon="pencil-square" size="sm" variant="primary" color="green" class="cursor-pointer"
            tooltip="Edit Paket" />
    </flux:modal.trigger>

    {{-- Modal Edit Paket --}}
    <flux:modal :name="'edit-package-' . $package->id" class="md:w-96 ">
        <div>
            <flux:heading size="lg">Edit Paket Layanan</flux:heading>
            <flux:subheading>Ubah informasi detail paket photo booth ini.</flux:subheading>
        </div>

        <form wire:submit="update" class="space-y-4">
            {{-- Input Nama Paket --}}
            <flux:input wire:model="name" label="Nama Paket" placeholder="Contoh: Paket High School (3 Frame)"
                required />

            {{-- Input Deskripsi Paket --}}
            <flux:textarea wire:model="desc" label="Deskripsi"
                placeholder="Keterangan singkat isi atau fasilitas paket..." rows="3" />

            {{-- Modal Actions --}}
            <div class="flex items-center justify-end gap-2 pt-2">
                <flux:modal.close>
                    <flux:button variant="ghost">Batal</flux:button>
                </flux:modal.close>

                <flux:button type="submit" variant="primary" wire:loading.attr="disabled">
                    <span wire:loading.remove wire:target="update">Simpan Perubahan</span>
                    <span wire:loading wire:target="update">Menyimpan...</span>
                </flux:button>
            </div>
        </form>
    </flux:modal>
</div>
