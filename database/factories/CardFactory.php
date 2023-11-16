<?php

namespace Database\Factories;

use App\Models\Card;
use Illuminate\Database\Eloquent\Factories\Factory;

class CardFactory extends Factory
{
    protected $model = Card::class;

    public function definition(): array
    {
        return [
            'card_number' => $this->generateUniqueCardNumber(),
        ];
    }

    private function generateUniqueCardNumber(): string
    {
        $uniqueCardNumber = $this->generateFake();
        return Card::where('card_number', $uniqueCardNumber)->exists()
            ? $this->generateUniqueCardNumber()
            : $uniqueCardNumber;
    }

    private function generateFake(): string
    {
        $validPrefixes = [4, 5, 6];
        $prefix = $validPrefixes[array_rand($validPrefixes)];

        $cardNumber = (string) $prefix;

        for ($i = 1; $i < 15; $i++) {
            $cardNumber .= mt_rand(0, 9);
        }

        $res = 0;
        for ($i = 0; $i < 15; $i++) {
            $digit = intval($cardNumber[$i]);
            if ($i % 2 == 0) {
                $digit *= 2;
                if ($digit >= 10) {
                    $digit -= 9;
                }
            }
            $res += $digit;
        }

        $lastDigit = (10 - ($res % 10)) % 10;
        $cardNumber .= $lastDigit;

        return $cardNumber;
    }

}
