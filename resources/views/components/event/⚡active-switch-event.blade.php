<?php

use App\Models\Event;
use Flux\Flux;
use Livewire\Component;

new class extends Component {
    public Event $event;

    public function toggleStatus(): void
    {
        $this->event->is_active = !$this->event->is_active;
        $this->event->save();

        $statusText = $this->event->is_active ? 'diaktifkan' : 'dinonaktifkan';

        Flux::toast(variant: 'success', text: "Event \"{$this->event->name}\" berhasil {$statusText}.");

        // Opsional: Beritahu parent table jika perlu refresh
        $this->dispatch('event-updated');
    }
};
?>

<div class="flex items-center gap-3">
    {{-- Switch dengan proteksi disabled & opacity saat loading --}}
    <flux:switch accent="emerald" :checked="$event->is_active" wire:change="toggleStatus" wire:loading.attr="disabled"
        wire:target="toggleStatus" class="cursor-pointer disabled:cursor-not-allowed disabled:opacity-60" />

    {{-- Badge Normal (Tampil saat idle) --}}
    <flux:badge wire:loading.remove wire:target="toggleStatus" size="sm" inset="top bottom"
        :color="$event->is_active ? 'emerald' : 'zinc'" :icon="$event->is_active ? 'check-circle' : 'x-circle'">
        {{ $event->is_active ? 'Aktif' : 'Nonaktif' }}
    </flux:badge>


    <flux:icon wire:loading wire:target="toggleStatus" icon="arrow-path" class="size-3 animate-spin" />
</div>
