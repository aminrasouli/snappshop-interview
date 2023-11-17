<?php

namespace App\Repositories\Account;

use App\Models\Account;
use App\Models\Card;

interface AccountRepositoryInterface
{
    public function getByCard(Card $card): ?Account;

    public function hasEnoughBalance(Account $account, int $amount): bool;

    public function increaseBalance(Account $account, int $amount): void;

    public function decreaseBalance(Account $account, int $amount): void;

}
