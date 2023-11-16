<?php

namespace Database\Factories;

use App\Models\Transaction;
use App\Models\TransactionFee;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFeeFactory extends Factory
{
    protected $model = TransactionFee::class;

    public function definition(): array
    {
        return [
            'transaction_id' => Transaction::factory(),
            'fee' => 5000,
        ];
    }
}
