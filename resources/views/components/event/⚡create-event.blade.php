<?php

use App\Models\Event;
use Flux\Flux;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component {
    use WithFileUploads;

    public string $name = '';
    public ?string $desc = null;
    public ?string $location = null;
    public string $event_date = '';
    public $logo;

    public function save(): void
    {
        $validated = $this->validate(
            [
                'name' => 'required|string|max:255',
                'desc' => 'nullable|string',
                'location' => 'nullable|string|max:255',
                'event_date' => [
                    'required',
                    'date',
                    Rule::unique('events', 'event_date'), // Menolak jika tanggal sudah dipakai event lain
                ],
                'logo' => 'nullable|image|max:2048',
            ],
            [
                'event_date.unique' => 'Sudah ada event lain yang terdaftar pada tanggal ini.',
            ],
        );

        $validated['logo'] = $this->logo->store('event-logo', 'public');

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

            {{-- Logo / Foto Event --}}
            <div class="space-y-2">
                <flux:label>Logo / Foto Event</flux:label>
                @if ($logo)
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
                            <p class="text-[11px] text-zinc-500 dark:text-zinc-400 mt-0.5">Siap diunggah</p>
                            <div class="mt-2 flex items-center gap-2">
                                <flux:button wire:click="$set('logo', null)" type="button" size="xs"
                                    variant="danger" icon="trash">
                                    Hapus
                                </flux:button>
                            </div>
                        </div>
                    </div>
                @else
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
