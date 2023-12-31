<?php

return [
    'source_card' => [
        'required' => 'شماره کارت مبدا الزامی است.',
        'card_number' => 'شماره کارت مبدا معتبر نیست.',
    ],
    'destination_card' => [
        'required' => 'شماره کارت مقصد الزامی است.',
        'card_number' => 'شماره کارت مقصد معتبر نیست.',
        'different' => 'شماره کارت مبدا و مقصد نباید یکسان باشد.',
    ],
    'amount' => [
        'required' => 'مبلغ الزامی است.',
        'min' => 'حداقل مبلغ ۱۰,۰۰۰ ریال است.',
        'max' => 'حداکثر مبلغ ۵۰۰,۰۰۰,۰۰۰ ریال است.',
    ],
];
