<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory;

        protected $fillable = [
            'amount',
            'source_card_id',
            'destination_card_id',
    ];

    public function sourceCard(): BelongsTo
    {
        return $this->belongsTo(Card::class, 'source_card_id');
    }

    public function destinationCard(): BelongsTo
    {
        return $this->belongsTo(Card::class, 'destination_card_id');
    }

    public function transactionFee(): HasOne
    {
        return $this->hasOne(TransactionFee::class);
    }
}
