<?php

namespace App\Repositories\TransactionFee;

use App\Models\TransactionFee;

interface TransactionFeeRepositoryInterface
{
    public function create(int $transactionId): TransactionFee;
}
