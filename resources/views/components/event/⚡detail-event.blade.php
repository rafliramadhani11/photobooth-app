<?php

use App\Models\Event;
use Flux\Flux;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component {
    use WithFileUploads;

    public Event $event;

    public string $name = '';
    public ?string $desc = null;
    public ?string $location = null;
    public string $event_date = '';
    public $logo = null;

    public function mount(Event $event): void
    {
        $this->event = $event;
        $this->name = $event->name;
        $this->desc = $event->desc;
        $this->location = $event->location;
        $this->event_date = $event->event_date;
    }

    public function update(): void
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'event_date' => 'required|date',
            'logo' => 'image|max:1024|nullable',
        ]);

        if ($this->logo) {
            if ($this->event->logo && Storage::disk('s3')->exists($this->event->logo)) {
                Storage::disk('s3')->delete($this->event->logo);
            }

            $validated['logo'] = $this->logo->store('event-logo');
            $this->logo->delete();
        } else {
            unset($validated['logo']);
        }

        $this->event->update($validated);

        $this->reset('logo');
        $this->dispatch('event-updated');

        Flux::toast(variant: 'success', text: 'Detail event berhasil diperbarui.');
    }
};
?>

<flux:card class="space-y-5">
    <div>
        <flux:heading size="lg">Detail & Edit Event</flux:heading>
        <flux:subheading>Informasi dan pengaturan acara photo booth.</flux:subheading>
    </div>

    <flux:separator variant="subtle" />

    <form class="space-y-4" wire:submit="update">
        <div class="pt-1">
            <span class="text-xs text-zinc-500 dark:text-zinc-400 block mb-1.5 font-medium">Status Operasional</span>
            <livewire:event.active-switch-event :event="$event" :key="'active-switch-' . $event->id" />
        </div>

        {{-- Preview & Logo / Foto Event --}}
        <div class="space-y-2">
            <flux:label>Logo / Foto Event</flux:label>
            @if ($logo && method_exists($logo, 'temporaryUrl'))
                {{-- Baru dipilih (temporary preview) --}}
                <div
                    class="flex items-center gap-4 p-3 rounded-xl border border-zinc-200 dark:border-zinc-700 bg-zinc-50/50 dark:bg-zinc-800/40">
                    <div
                        class="relative size-16 shrink-0 rounded-lg overflow-hidden border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 shadow-xs">
                        <img src="{{ $logo->temporaryUrl() }}" alt="Preview Logo" class="size-full object-cover">
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-medium text-zinc-900 dark:text-zinc-100 truncate">
                            {{ method_exists($logo, 'getClientOriginalName') ? $logo->getClientOriginalName() : 'Foto Terpilih' }}
                        </p>
                        <p class="text-[11px] text-emerald-600 dark:text-emerald-400 mt-0.5 font-medium">Foto baru
                            dipilih</p>
                        <div class="mt-2 flex items-center gap-2">
                            <flux:button wire:click="$set('logo', null)" type="button" size="xs" variant="danger"
                                icon="trash">
                                Batalkan
                            </flux:button>
                        </div>
                    </div>
                </div>
            @elseif ($event->logo)
                {{-- Foto yang tersimpan saat ini --}}
                <div
                    class="flex items-center gap-4 p-3 rounded-xl border border-zinc-200 dark:border-zinc-700 bg-zinc-50/50 dark:bg-zinc-800/40">
                    <div
                        class="relative size-16 shrink-0 rounded-lg overflow-hidden border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 shadow-xs">
                        <img src="{{ Storage::disk('s3')->url($event->logo) }}" alt="Logo Event"
                            class="size-full object-cover">
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-medium text-zinc-900 dark:text-zinc-100 truncate">
                            Logo Tersimpan
                        </p>
                        <p class="text-[11px] text-zinc-500 dark:text-zinc-400 mt-0.5">Digunakan saat ini</p>
                        <div class="mt-2 flex items-center gap-2">
                            <label
                                class="cursor-pointer inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-medium rounded-lg bg-zinc-100 dark:bg-zinc-700 hover:bg-zinc-200 dark:hover:bg-zinc-600 text-zinc-700 dark:text-zinc-200 transition-colors">
                                <flux:icon icon="arrow-path" class="size-3.5" />
                                <span>Ganti Foto</span>
                                <input wire:model="logo" type="file" accept="image/*" class="sr-only" />
                            </label>
                        </div>
                    </div>
                </div>
            @else
                {{-- Belum ada logo --}}
                <label
                    class="group relative flex flex-col items-center justify-center p-5 border-2 border-dashed border-zinc-200 dark:border-zinc-700 hover:border-sky-500 dark:hover:border-sky-400 rounded-xl cursor-pointer bg-zinc-50/50 dark:bg-zinc-800/30 hover:bg-sky-50/30 dark:hover:bg-sky-950/20 transition-colors">
                    <div
                        class="p-2.5 rounded-full bg-white dark:bg-zinc-800 shadow-xs text-zinc-400 group-hover:text-sky-500 dark:group-hover:text-sky-400 group-hover:scale-110 transition-transform">
                        <flux:icon icon="arrow-up-tray" class="size-5" />
                    </div>
                    <div class="text-center mt-2.5">
                        <span
                            class="text-xs font-medium text-zinc-700 dark:text-zinc-200 group-hover:text-sky-600 dark:group-hover:text-sky-400">
                            Klik untuk upload logo
                        </span>
                        <span class="text-zinc-400 text-xs"> atau drag & drop</span>
                        <p class="text-[11px] text-zinc-400 dark:text-zinc-500 mt-1">PNG, JPG, atau WEBP (Maks. 1MB)
                        </p>
                    </div>
                    <input wire:model="logo" type="file" accept="image/*" class="sr-only" />
                </label>
            @endif
            <flux:error name="logo" />
        </div>

        {{-- Nama Event --}}
        <flux:input wire:model="name" label="Nama Event" placeholder="Contoh: Wedding Anisa & Budi" required />

        {{-- Tanggal Pelaksanaan --}}
        <flux:input wire:model="event_date" label="Tanggal Pelaksanaan" type="date" required />

        {{-- Lokasi / Venue --}}
        <flux:input wire:model="location" label="Lokasi / Venue" placeholder="Contoh: Hotel Mulia Jakarta" />

        {{-- Deskripsi --}}
        <flux:textarea wire:model="desc" label="Deskripsi" placeholder="Catatan atau keterangan event..."
            rows="3" />

        {{-- Actions --}}
        <flux:button type="submit" variant="primary" class="w-full">Simpan Perubahan</flux:button>
    </form>
</flux:card>
