<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\Repository;
use Carbon\Carbon;
use DB;

class UserRepository extends Repository implements UserRepositoryInterface
{

    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function getTopUserIdsThatHasMostTransactions(int $limit = 3, int $lastMinutes = 10): array
    {
        $usersIds = $this->builder
            ->join('accounts', 'accounts.user_id', '=', 'users.id')
            ->join('cards', 'cards.account_id', '=', 'accounts.id')
            ->join('transactions', fn($join) => $join->on('transactions.source_card_id', '=', 'cards.id')
                ->orWhere('transactions.destination_card_id', '=', 'cards.id')
            )
            ->where('transactions.created_at', '>=', Carbon::now()->subMinutes($lastMinutes))
            ->groupBy('users.id')
            ->orderByRaw('SUM(transactions.amount) DESC')
            ->limit($limit)
            ->pluck('users.id');

        return $usersIds->toArray();
    }
}
