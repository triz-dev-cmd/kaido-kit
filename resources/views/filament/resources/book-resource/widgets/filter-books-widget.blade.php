<x-filament-widgets::widget>
    <x-filament::section>
        <form wire:submit="filter">
            {{ $this->form }}

            <div class="flex items-center justify-start gap-4 mt-3">
                <x-filament::button type="submit">
                    {{ __('Filter') }}
                </x-filament::button>

                <x-filament::button type="button" color="secondary" wire:click="resetFilter">
                    {{ __('Reset') }}
                </x-filament::button>
            </div>
        </form>
    </x-filament::section>
</x-filament-widgets::widget>
