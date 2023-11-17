<?php

namespace App\Providers;

use App\Lib\SMSProviders\GhasedakSMSProvider;
use App\Lib\SMSProviders\KavenegarSMSProvider;
use Illuminate\Support\ServiceProvider;

class SMSServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(KavenegarSMSProvider::class, function () {
            return new KavenegarSMSProvider();
        });

        $this->app->bind(GhasedakSMSProvider::class, function () {
            return new GhasedakSMSProvider();
        });
    }

    public function boot(): void
    {
    }
}
