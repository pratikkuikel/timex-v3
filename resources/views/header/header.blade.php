<div class="sm:justify-between sm:items-center grid sm:flex gap-2">
    <div class="flex">
        <x-filament::dropdown placement="top-start" :dark-mode="true">
            <x-slot name="trigger" class="hover:bg-gray-500/10 rounded-lg pl-2 pr-2 -ml-2">
                <div class="filament-header-heading text-2xl font-bold tracking-tight">
                    <div class="flex items-center">
                        <div>
                            {{ $this->monthName }}
                        </div>
                        <x-dynamic-component :component="'heroicon-o-chevron-down'" class="h-5 w-5 ml-2" />
                    </div>
                </div>
            </x-slot>
            <x-filament::dropdown.list>
                <x-filament::dropdown.list.index>
                    <div class="grid gap-2">
                        <x-filament::button :dark-mode="true" :outlined="true" :color="'primary'" :size="'sm'">
                            <div class="flex items-center justify-between">
                                <div wire:click="$dispatch('onPrevDropDownYearClick')">
                                    <x-dynamic-component :component="'heroicon-o-chevron-double-left'" class="w-4 h-4" />
                                </div>
                                <div style="padding-left: 50px; padding-right: 50px;">
                                    {{ $this->getYearFormat($this->year) }}
                                </div>
                                <div wire:click="$dispatch('onNextDropDownYearClick')">
                                    <x-dynamic-component :component="'heroicon-o-chevron-double-right'" class="w-4 h-4" />
                                </div>
                            </div>
                            </x-filament::button>
                            <div class="grid grid-cols-1">
                                <div @class(['grid gap-1', 'grid-cols-' . config('timex.dropDownCols', 3)])>
                                    @foreach ($this->period as $month)
                                        @php
                                            $color = \Carbon\Carbon::create($month)->isCurrentMonth()
                                                ? 'primary'
                                                : 'secondary';
                                        @endphp
                                        <x-filament::button wire:key="{{ rand() }}" x-on:click="close();"
                                            wire:click="$dispatch('onMonthDropDownClick','{{ $month->timestamp }}')"
                                            :size="'sm'" :outlined="true" :color="$color" :dark-mode="true">
                                            {{ $month->shortMonthName }}
                                            </x-filament::button>
                                    @endforeach
                                </div>
                            </div>
                    </div>
                    </x-filament::dropdown.list.index>
                    </x-filament::dropdown.list>
                    </x-filament::dropdown>
    </div>
    <div class="flex items-center gap-2 justify-between">
        <div class="flex">
            <x-filament::button :size="'sm'" :dark-mode="true" :color="'secondary'" :outlined="config('timex.pages.buttons.outlined')">
                <div wire:click="$dispatch('onTodayClick')">
                    {{ config('timex.pages.buttons.today.static') ? trans('timex::timex.labels.today') : self::getDynamicLabel('today') }}
                </div>
                </x-filament::button>
        </div>
        <div class="flex gap-2">
            <x-filament::button :dark-mode="true" :size="'sm'" :outlined="true">
                <div class="flex gap-3 items-center">
                    @unless (config('timex.pages.buttons.hideYearNavigation', false))
                        <x-dynamic-component wire:click="$dispatch('onPreviousYearClick')" :component="config('timex.pages.buttons.icons.previousYear', 'heroicon-o-chevron-double-left')"
                            class="h-4 w-4 text-gray-500" />
                    @endunless
                    <x-dynamic-component wire:click="$dispatch('onPrevClick')" :component="config('timex.pages.buttons.icons.previousMonth')" class="h-4 w-4" />
                    <span class="border-primary-600 dark:border-gray-400 rounded h-3 ml-2 mr-2"
                        style="border-width: 0.5px;">
                    </span>
                    <x-dynamic-component wire:click="$dispatch('onNextClick')" :component="config('timex.pages.buttons.icons.nextMonth')" class="h-4 w-4" />
                    @unless (config('timex.pages.buttons.hideYearNavigation', false))
                        <x-dynamic-component wire:click="$dispatch('onNextYearClick')" :component="config('timex.pages.buttons.icons.nextYear', 'heroicon-o-chevron-double-right')"
                            class="h-4 w-4 text-gray-500" />
                    @endunless
                </div>
                </x-filament::button>
                <x-filament::button wire:click="$dispatch('onCreateClick')" :outlined="true" :dark-mode="true"
                    :size="'sm'">
                    <div class="flex items-center gap-2">
                        <x-dynamic-component :component="config('timex.pages.buttons.icons.createEvent')" class="h-4 w-4" />
                        <div class="hidden lg:flex">
                            {{ trans('filament::resources/pages/create-record.title', [
                                'label' => Str::lower(__('timex::timex.model.label')),
                            ]) }}
                        </div>
                    </div>
                    </x-filament::button>
        </div>
    </div>
</div>
