<x-layouts::app :title="__('Events')">
    <div class="space-y-15">
        {{-- Page Header Section --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                {{-- Flux Breadcrumbs --}}
                <flux:breadcrumbs class="mb-3">
                    <flux:breadcrumbs.item href="{{ route('dashboard') }}" icon="home" />
                    <flux:breadcrumbs.item>{{ __('Events') }}</flux:breadcrumbs.item>
                </flux:breadcrumbs>

                {{-- Page Title & Description --}}
                <flux:heading size="xl" level="1">{{ __('Events') }}</flux:heading>
                <flux:subheading size="lg">
                    {{ __('Kelola seluruh daftar acara, lokasi, dan status operasional photo booth.') }}
                </flux:subheading>
            </div>

            {{-- Primary Action Button --}}
            <div class="flex items-center gap-3">
                <livewire:event.create-event />
            </div>
        </div>

        {{-- Table Section --}}
        <div>
            <livewire:event.event-table />
        </div>
    </div>
</x-layouts::app>
