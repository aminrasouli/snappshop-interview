<?php

namespace App\Services;

use App\Http\Resources\UserWithTransactionResource;
use App\Repositories\Transaction\TransactionRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Collection;

class UserService
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly TransactionRepository $transactionRepository,
    ) {
    }

    public function getTopUsersThatHasMostTransactions(
        int $limit = 3,
        int $lastMinutes = 10
    ): Collection {
        $users = $this->userRepository->getByIds(
            $this->userRepository->getTopUserIdsThatHasMostTransactions($limit, $lastMinutes)
        );

        $userWithTransaction = collect();

        $users->each(function ($user) use ($userWithTransaction) {
            $user->setRelation(
                'transactions',
                $this->transactionRepository->getLastTransactionsByUserId($user['id'])
            );
            $userWithTransaction->push(new UserWithTransactionResource($user));
        });

        return $userWithTransaction;
    }
}
