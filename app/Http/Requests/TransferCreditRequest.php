<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Str;

class TransferCreditRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'source_card' => ['required', 'card_number'],
            'destination_card' => ['required', 'card_number', 'different:source_card'],
            'amount' => ['required', 'numeric', 'min:10000', 'max:500000000'],
        ];
    }

    public function prepareForValidation(): void
    {
        if ($this->has('source_card')) {
            $this->merge([
                'source_card' => (int) Str::toEnglishNumber($this->source_card),
            ]);
        }

        if ($this->has('destination_card')) {
            $this->merge([
                'destination_card' => (int) Str::toEnglishNumber($this->destination_card),
            ]);
        }

        if ($this->has('amount')) {
            $this->merge([
                'amount' => (int) Str::toEnglishNumber($this->amount),
            ]);
        }
    }

    public function messages(): array
    {
        return [
            'source_card.required' => 'شماره کارت مبدا الزامی است.',
            'source_card.card_number' => 'شماره کارت مبدا معتبر نیست.',
            'destination_card.required' => 'شماره کارت مقصد الزامی است.',
            'destination_card.card_number' => 'شماره کارت مقصد معتبر نیست.',
            'destination_card.different' => 'شماره کارت مبدا و مقصد نباید یکسان باشد.',
            'amount.required' => 'مبلغ الزامی است.',
            'amount.min' => 'حداقل مبلغ ۱۰,۰۰۰ ریال است.',
            'amount.max' => 'حداکثر مبلغ ۵۰۰,۰۰۰,۰۰۰ ریال است.',
        ];
    }
}
