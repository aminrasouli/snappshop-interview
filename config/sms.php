<?php

use App\Lib\SMSProviders\GhasedakSMSProvider;
use App\Lib\SMSProviders\KavenegarSMSProvider;

return [
    'default' => env('SMS_DEFAULT_PROVIDER', 'kavenegar'),
    'providers' => [
        'kavenegar' => [
            'driver' => KavenegarSMSProvider::class,
            'api_key' => env('KAVENEGAR_API_KEY'),
            'sender' => '10004346',
        ],
        'ghasedak' => [
            'driver' => GhasedakSMSProvider::class,
            'api_key' => env('GHASEDAK_API_KEY'),
        ]
    ],
];
