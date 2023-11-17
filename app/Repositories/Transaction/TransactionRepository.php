<?php

namespace App\Repositories\Transaction;

use App\Models\Transaction;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Collection;

class TransactionRepository extends Repository implements TransactionRepositoryInterface
{

    public function __construct(Transaction $model)
    {
        parent::__construct($model);
    }

    public function create(int $sourceCardId, int $destinationCardId, int $amount): Transaction
    {
        return $this->model->create([
            'source_card_id' => $sourceCardId,
            'destination_card_id' => $destinationCardId,
            'amount' => $amount,
        ]);
    }

    public function getLastTransactionsByUserId(int $userId, int $limit = 10): Collection
    {
        return $this->model
            ->whereHas('sourceCard.account', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->orWhereHas('destinationCard.account', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }
}
