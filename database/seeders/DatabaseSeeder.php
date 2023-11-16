<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Card;
use App\Models\Transaction;
use App\Models\TransactionFee;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(10)->create();

        $accounts = $users->flatMap(
            fn(User $user) => Account::factory(3)
                ->for($user)
                ->create()
        );

        $cards = $accounts->flatMap(
            fn(Account $account) => Card::factory(2)
                ->for($account)
                ->create()
        );

        $transactions = $cards->flatMap(
            fn(Card $card) => Transaction::factory(15)
                ->for($card, 'sourceCard')
                ->state(new Sequence(
                    fn(Sequence $sequence) => ['destination_card_id' => $cards->where('id', '!=', $card->id)->random()],
                ))
                ->create()
        );

        $transactions = $cards->flatMap(
            fn(Card $card) => Transaction::factory(15)
                ->for($card, 'sourceCard')
                ->state(new Sequence(
                    fn(Sequence $sequence) => ['destination_card_id' => $cards->where('id', '!=', $card->id)->random()],
                ))
                ->create()
        );

        $transactions->flatMap(
            fn(Transaction $transaction) => TransactionFee::factory()
                ->for($transaction)
                ->create()
        );
    }
}
