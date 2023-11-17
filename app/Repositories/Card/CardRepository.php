<?php

namespace App\Repositories\Card;

use App\Models\Card;
use App\Repositories\Repository;

class CardRepository extends Repository implements CardRepositoryInterface
{

    public function __construct(Card $model)
    {
        parent::__construct($model);
    }

    public function getByCardNumber(string $cardNumber): ?Card
    {
        return $this->model
            ->where('card_number', $cardNumber)
            ->first();
    }
}
