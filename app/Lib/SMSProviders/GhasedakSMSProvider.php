<?php

namespace App\Lib\SMSProviders;

use Exception;
use Ghasedak\Exceptions\ApiException;
use Ghasedak\Exceptions\HttpException;
use Ghasedak\GhasedakApi;
use Log;

class GhasedakSMSProvider implements SMSProvider
{
    private GhasedakApi $provider;
    private string $apiKey;

    public function __construct()
    {
        $this->apiKey = config("sms.providers.ghasedak.api_key");
        $this->provider = new GhasedakApi($this->apiKey);
    }

    /**
     * @throws Exception
     */
    public function send(string $to, string $message)
    {
        try {
            return $this->provider->SendSimple($to, $message);
        } catch (HttpException|ApiException|Exception $e) {
            Log::error($e);
            throw $e;
        }
    }
}
