<?php

use App\Models\Event;
use Flux\Flux;
use Livewire\Component;

new class extends Component {
    public Event $event;

    public function delete(): void
    {
        $this->event->delete();

        Flux::modal('delete-event-' . $this->event->id)->close();
        Flux::toast(variant: 'success', text: 'Event berhasil dihapus.');

        // Memicu refresh data pada tabel
        $this->dispatch('event-updated');
    }
};
?>

<div>
    {{-- Trigger Button dengan Ikon Trash --}}
    <flux:modal.trigger :name="'delete-event-' . $event->id">
        <flux:button icon="trash" size="sm" variant="danger" tooltip="Hapus Event" class="cursor-pointer">
            Hapus
        </flux:button>
    </flux:modal.trigger>

    {{-- Modal Konfirmasi Hapus --}}
    <flux:modal :name="'delete-event-' . $event->id" class="md:w-md">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Hapus Event?</flux:heading>
                <flux:subheading class="mt-1">
                    Apakah kamu yakin ingin menghapus event <strong
                        class="text-zinc-900 dark:text-white">{{ $event->name }}</strong> ? Tindakan ini tidak dapat
                    dibatalkan.
                </flux:subheading>
            </div>

            <div class="flex items-center gap-2 pt-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Batal</flux:button>
                </flux:modal.close>

                <flux:button wire:click="delete" variant="danger" wire:loading.attr="disabled">
                    Ya, Hapus
                </flux:button>
            </div>
        </div>
    </flux:modal>
</div>
