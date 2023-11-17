<?php


namespace App\Lib\SMSProviders;

interface SMSProvider
{
    function send(string $to, string $message);

}
