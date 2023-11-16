<?php

namespace App\Providers;

use App\Rules\CardNumberRule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class ValidatorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Validator::extend('card_number', function ($attribute, $value): bool {
            return (new CardNumberRule)->passes($attribute, $value);
        });

        Validator::replacer('card_number', function ($message, $attribute): array|string {
            return str_replace(':attribute', $attribute, $message);
        });
    }
}
