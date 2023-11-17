<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserWithTransactionResource;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(
        private readonly UserService $userService
    ) {
    }

    public function top()
    {
        return UserWithTransactionResource::collection(
            $this->userService->getTopUsersThatHasMostTransactions()
        );
    }
}
