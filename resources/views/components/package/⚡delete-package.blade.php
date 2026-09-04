<?php

use App\Models\Package;
use Flux\Flux;
use Livewire\Component;

new class extends Component {
    public Package $package;

    public function delete(): void
    {
        $this->package->delete();

        Flux::modal('delete-package-' . $this->package->id)->close();
        Flux::toast(variant: 'success', text: 'Paket berhasil dihapus.');

        // Memicu refresh data pada tabel
        $this->dispatch('package-updated');
    }
};
?>

<div>
    {{-- Trigger Button Icon Trash --}}
    <flux:modal.trigger :name="'delete-package-' . $package->id">
        <flux:button icon="trash" size="sm" variant="danger" class="cursor-pointer" tooltip="Hapus Paket" />
    </flux:modal.trigger>

    {{-- Modal Konfirmasi Hapus --}}
    <flux:modal :name="'delete-package-' . $package->id" class="md:w-md ">
        <div>
            <flux:heading size="lg">Hapus Paket Layanan?</flux:heading>
            <flux:subheading class="mt-1">
                Apakah kamu yakin ingin menghapus paket <strong
                    class="text-zinc-900 dark:text-white">{{ $package->name }}</strong> ? Tindakan ini tidak dapat
                dibatalkan.
            </flux:subheading>
        </div>

        <div class="flex items-center justify-end gap-2 pt-2">
            <flux:modal.close>
                <flux:button variant="ghost">Batal</flux:button>
            </flux:modal.close>

            <flux:button wire:click="delete" variant="danger" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="delete">Ya, Hapus</span>
                <span wire:loading wire:target="delete">Menghapus...</span>
            </flux:button>
        </div>
    </flux:modal>
</div>
