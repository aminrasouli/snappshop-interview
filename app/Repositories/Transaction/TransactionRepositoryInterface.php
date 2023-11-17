<?php

namespace App\Repositories\Transaction;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Collection;

interface TransactionRepositoryInterface
{
    public function create(int $sourceCardId, int $destinationCardId, int $amount): Transaction;

    public function getLastTransactionsByUserId(int $userId, int $limit = 10): Collection;
}
