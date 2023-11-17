<?php

namespace App\Repositories\Card;

use App\Models\Card;

interface CardRepositoryInterface
{
    public function getByCardNumber(string $cardNumber): ?Card;
}
