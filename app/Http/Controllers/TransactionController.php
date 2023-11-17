<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransferCreditRequest;
use App\Http\Resources\TransactionResource;
use App\Services\TransactionService;

class TransactionController extends Controller
{
    public function __construct(
        private readonly TransactionService $transactionService
    ) {
    }

    public function transfer(TransferCreditRequest $request)
    {
        $transaction = $this->transactionService->transfer(
            $request->source_card,
            $request->destination_card,
            $request->amount,
        );

        return new TransactionResource(
            $transaction,
        );
    }
}
