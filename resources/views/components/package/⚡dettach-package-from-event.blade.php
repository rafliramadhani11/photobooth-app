<?php

use App\Models\Event;
use App\Models\Package;
use Flux\Flux;
use Livewire\Component;

new class extends Component {
    public Event $event;
    public Package $package;

    public function detach(): void
    {
        $this->event->packages()->detach($this->package->id);

        Flux::modal('detach-package-' . $this->package->id)->close();
        Flux::toast(variant: 'success', text: 'Paket berhasil dilepas dari event.');

        $this->dispatch('package-updated');
    }
};
?>

<div>
    {{-- Trigger Button --}}
    <flux:modal.trigger :name="'dettach-package-' . $package->id">
        <flux:button icon="link-slash" size="sm" variant="primary" color="amber" class=" cursor-pointer"
            tooltip="Lepaskan Paket" />
    </flux:modal.trigger>

    {{-- Modal Konfirmasi --}}
    <flux:modal :name="'dettach-package-' . $package->id" class="md:w-md">
        <div>
            <flux:heading size="lg">Hapus Paket dari Event?</flux:heading>
            <flux:subheading class="mt-1">
                Apakah kamu yakin ingin melepas paket <strong
                    class="text-zinc-900 dark:text-white">{{ $package->name }}</strong> dari event ini? Tindakan ini
                tidak akan menghapus master data paket.
            </flux:subheading>
        </div>

        <div class="flex items-center justify-end gap-2 pt-2">
            <flux:modal.close>
                <flux:button variant="ghost">Batal</flux:button>
            </flux:modal.close>

            <flux:button wire:click="detach" variant="danger" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="detach">Ya, Lepaskan</span>
                <span wire:loading wire:target="detach">Melepas...</span>
            </flux:button>
        </div>
    </flux:modal>
</div>