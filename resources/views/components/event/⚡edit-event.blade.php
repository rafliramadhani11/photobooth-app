<?php

use App\Models\Event;
use Flux\Flux;
use Livewire\Component;

new class extends Component {
    public Event $event;

    public string $name = '';
    public ?string $desc = null;
    public ?string $location = null;
    public string $event_date = '';

    public function mount(): void
    {
        $this->name = $this->event->name;
        $this->desc = $this->event->desc;
        $this->location = $this->event->location;
        $this->event_date = $this->event->event_date;
    }

    public function update(): void
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'event_date' => 'required|date',

        ]);

        $this->event->update($validated);

        Flux::modal('edit-event-' . $this->event->id)->close();
        Flux::toast(variant: 'success', text: 'Event berhasil diperbarui.');

        $this->dispatch('event-updated');
    }
};
?>

<div>
    <flux:modal.trigger :name="'edit-event-' . $event->id">
        <flux:button icon="pencil-square" size="sm" class="text-xs cursor-pointer" variant="primary" color="green">
            Edit
        </flux:button>
    </flux:modal.trigger>

    <flux:modal :name="'edit-event-' . $event->id" class="md:w-md">
        <form wire:submit="update" class="space-y-5">
            <div>
                <flux:heading size="lg">Edit Event</flux:heading>
                <flux:subheading class="mt-1">
                    Ubah detail informasi event photo booth ini.
                </flux:subheading>
            </div>

            <flux:input wire:model="name" label="Nama Event" placeholder="Contoh: Wedding Anisa & Budi" required />

            <flux:input wire:model="event_date" label="Tanggal Pelaksanaan" type="date" required />

            <flux:input wire:model="location" label="Lokasi / Venue" placeholder="Contoh: Hotel Mulia Jakarta" />

            <flux:textarea wire:model="desc" label="Deskripsi" placeholder="Catatan atau keterangan paket..."
                rows="3" />

            <div class="flex items-center gap-2 pt-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Batal</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary">Simpan Perubahan</flux:button>
            </div>
        </form>
    </flux:modal>
</div>