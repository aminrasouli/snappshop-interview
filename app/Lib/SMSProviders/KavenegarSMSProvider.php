<?php

namespace App\Lib\SMSProviders;

use Exception;
use Kavenegar\Exceptions\ApiException;
use Kavenegar\Exceptions\HttpException;
use Kavenegar\KavenegarApi;
use Log;

class KavenegarSMSProvider implements SMSProvider
{
    private KavenegarApi $provider;
    private string $apiKey;
    private string $sender;

    public function __construct()
    {
        $this->apiKey = config("sms.providers.kavenegar.api_key");
        $this->sender = config("sms.providers.kavenegar.sender");
        $this->provider = new KavenegarApi($this->apiKey);
    }

    public function send(string $to, string $message)
    {
        try {
            return $this->provider->Send($this->sender, $to, $message);
        } catch (ApiException|HttpException|Exception $e) {
            Log::error($e);
            throw $e;
        }
    }
}
