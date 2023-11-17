<?php

namespace App\Repositories\TransactionFee;

use App\Models\TransactionFee;
use App\Repositories\Repository;

class TransactionFeeRepository extends Repository implements TransactionFeeRepositoryInterface
{

    const TRANSACTION_FEE = 5000;

    public function __construct(TransactionFee $model)
    {
        parent::__construct($model);
    }

    public function getTransactionFee(): int
    {
        return self::TRANSACTION_FEE;
    }

    public function create(int $transactionId): TransactionFee
    {
        return $this->model->create([
            'transaction_id' => $transactionId,
            'fee' => $this->getTransactionFee()
        ]);
    }

}
