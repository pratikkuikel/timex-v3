<?php

namespace Buildix\Timex;

use Buildix\Timex\Pages\Timex;
use Buildix\Timex\Resources\EventResource;
use Closure;
use Filament\Contracts\Plugin;
use Filament\Panel;

class TimexPlugin implements Plugin
{
    public Closure | bool $shouldRegisterNavigation = true;

    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'timex';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->resources([
                EventResource::class,
            ])
            ->pages([
                Timex::class,
            ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
