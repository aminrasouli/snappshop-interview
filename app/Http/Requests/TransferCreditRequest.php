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
            'source_card.required' => __('validation.source_card.required'),
            'source_card.card_number' => __('validation.source_card.card_number'),
            'destination_card.required' => __('validation.destination_card.required'),
            'destination_card.card_number' => __('validation.destination_card.card_number'),
            'destination_card.different' => __('validation.destination_card.different'),
            'amount.required' => __('validation.amount.required'),
            'amount.min' => __('validation.amount.min'),
            'amount.max' => __('validation.amount.max'),
        ];
    }
}
