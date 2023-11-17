<?php

namespace Tests\Unit;

use App\Rules\CardNumberRule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use PHPUnit\Framework\TestCase;

class CardNumberRuleTest extends TestCase
{
    /** @test */
    public function it_passes_validation_for_valid_card_numbers()
    {
        $rule = new CardNumberRule();

        $validCardNumbers = [
            'Visa' => '4051927861651564',
            'MasterCard' => '5949892584362118',
            'Discover' => '6791870476120379',
        ];

        foreach ($validCardNumbers as $type => $cardNumber) {
            $this->assertTrue(
                $rule->passes('card_number', $cardNumber), "Failed for $type"
            );
        }
    }

    /** @test */
    public function it_fails_validation_for_invalid_card_numbers()
    {
        $rule = new CardNumberRule();

        $invalidCardNumbers = [
            '6829092126540992',
            '4096895393111671',
            '45563586099366302'
        ];

        foreach ($invalidCardNumbers as $cardNumber) {
            $this->assertFalse($rule->passes('card_number', $cardNumber));
        }
    }
}
