<?php

namespace App\Services;

use App\Events\TransactionCompleted;
use App\Models\Transaction;
use App\Repositories\Account\AccountRepository;
use App\Repositories\Card\CardRepository;
use App\Repositories\Transaction\TransactionRepository;
use App\Repositories\TransactionFee\TransactionFeeRepository;
use DB;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Throwable;
use Webmozart\Assert\Assert;

class TransactionService
{
    public function __construct(
        private readonly TransactionRepository $transactionRepository,
        private readonly TransactionFeeRepository $transactionFeeRepository,
        private readonly AccountRepository $accountRepository,
        private readonly CardRepository $cardRepository,
        private readonly EventDispatcher $eventDispatcher
    ) {
    }


    /**
     * @throws Throwable
     */
    public function transfer(int $sourceCardNumber, int $destinationCardNumber, int $amount): Transaction
    {
        try {
            DB::beginTransaction();

            $sourceCard = $this->cardRepository->getByCardNumber($sourceCardNumber);
            $destinationCard = $this->cardRepository->getByCardNumber($destinationCardNumber);

            Assert::notNull($sourceCard, 'Source card not found');
            Assert::notNull($destinationCard, 'Destination card not found');

            Assert::notEq($sourceCard->account_id, $destinationCard->account_id, 'Cannot transfer to the same account');

            $sourceAccount = $this->accountRepository->getByCard($sourceCard);
            $destinationAccount = $this->accountRepository->getByCard($destinationCard);

            Assert::notNull($sourceAccount, 'Source account not found');
            Assert::notNull($destinationAccount, 'Destination account not found');

            $hasEnoughBalance = $this->accountRepository->hasEnoughBalance(
                $sourceAccount,
                $amount
            );

            Assert::true($hasEnoughBalance, 'Source account does not have enough balance');

            $transaction = $this->transactionRepository->create($sourceCard->id, $destinationCard->id, $amount);
            $this->transactionFeeRepository->create($sourceCard->id);

            $this->accountRepository->decreaseBalance($sourceAccount, $amount);
            $this->accountRepository->increaseBalance($destinationAccount, $amount);

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        $this->eventDispatcher->dispatch(
            new TransactionCompleted($transaction)
        );

        return $transaction;
    }
}
