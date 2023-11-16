<?php

namespace App\Providers;

use App\Services\TextService;
use Illuminate\Support\ServiceProvider;
use Str;

class MacroServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Str::macro('toEnglishNumber', function (string $string): string {
            return app(TextService::class)->toEnglishNumber($string);
        });
    }
}
