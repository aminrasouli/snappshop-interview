<?php

namespace App\Listeners;

use App\Events\TransactionCompleted;
use App\Notifications\ReceivedTransaction;
use App\Notifications\SentTransaction;

class SendTransactionNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(TransactionCompleted $event): void
    {
        $event->transaction->sourceCard->account->user->notify(
            new SentTransaction($event->transaction)
        );
        $event->transaction->destinationCard->account->user->notify(
            new ReceivedTransaction($event->transaction)
        );
    }
}
