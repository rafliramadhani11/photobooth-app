<?php

use App\Models\Event;
use Flux\Flux;
use Livewire\Component;

new class extends Component {
    public string $name = '';
    public ?string $desc = null;
    public ?string $location = null;
    public string $event_date = '';

    public function save(): void
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'event_date' => 'required|date',
        ]);

        Event::create($validated);

        $this->reset();

        $this->dispatch('event-updated');

        Flux::modal('create-event')->close();
        Flux::toast(variant: 'success', text: 'Event berhasil dibuat.');
    }
};
?>

<div>
    <flux:modal.trigger name="create-event">
        <flux:button icon="plus" variant="primary" size="sm">New Event</flux:button>
    </flux:modal.trigger>

    <flux:modal name="create-event" class="md:w-md">
        <form wire:submit="save" class="space-y-5">
            <div>
                <flux:heading size="lg">Create Event</flux:heading>
                <flux:subheading class="mt-1">
                    Isi detail acara untuk menambahkan event photo booth baru.
                </flux:subheading>
            </div>

            {{-- Name --}}
            <flux:input wire:model="name" label="Nama Event" placeholder="Contoh: Wedding Anisa & Budi" required />

            {{-- Event Date --}}
            <flux:input wire:model="event_date" label="Tanggal Pelaksanaan" type="date" required />

            {{-- Location --}}
            <flux:input wire:model="location" label="Lokasi / Venue" placeholder="Contoh: Hotel Mulia Jakarta" />

            {{-- Description --}}
            <flux:textarea wire:model="desc" label="Deskripsi" placeholder="Catatan atau keterangan paket (opsional)..."
                rows="3" />

            {{-- Actions --}}
            <div class="flex items-center gap-2 pt-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Batal</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary">Create Event</flux:button>
            </div>
        </form>
    </flux:modal>
</div>
