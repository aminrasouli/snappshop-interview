<?php

namespace App\Repositories\User;

use App\Models\Card;

interface UserRepositoryInterface
{
    public function getTopUserIdsThatHasMostTransactions(int $limit = 3, int $lastMinutes = 10): array;
}
