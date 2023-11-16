<?php

namespace Database\Factories;

use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountFactory extends Factory
{
    protected $model = Account::class;

    public function definition(): array
    {
        return [
            'account_number' => $this->faker->unique()->numberBetween(
                1000000000, 9999999999
            ),
            'balance' => $this->faker->numberBetween(0, 1000000000),
        ];
    }
}
