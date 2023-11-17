<?php

namespace App\Notifications;

use App\Channels\SMSChannel;
use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class ReceivedTransaction extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        private readonly Transaction $transaction
    ) {
    }

    public function via(): string
    {
        return SMSChannel::class;
    }

    public function toSMS(object $notifiable): string
    {
        return __('message.transaction.sms.received', [
            'amount' => $this->transaction->amount,
        ], 'fa');
    }

}
