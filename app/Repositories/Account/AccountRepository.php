<?php

namespace App\Repositories\Account;

use App\Models\Account;
use App\Models\Card;
use App\Repositories\Repository;

class AccountRepository extends Repository implements AccountRepositoryInterface
{

    public function __construct(Account $model)
    {
        parent::__construct($model);
    }

    public function getByCard(Card $card): ?Account
    {
        return $card->account;
    }

    public function hasEnoughBalance(Account $account, int $amount): bool
    {
        return $account->balance >= $amount;
    }

    public function increaseBalance(Account $account, int $amount): void
    {
        $account->lockForUpdate()->increment('balance', $amount);
    }

    public function decreaseBalance(Account $account, int $amount): void
    {
        $account->lockForUpdate()->decrement('balance', $amount);
    }


}
