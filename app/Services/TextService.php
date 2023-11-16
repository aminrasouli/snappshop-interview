<?php

namespace App\Services;

class TextService
{
    public function toEnglishNumber(?string $text): ?string
    {
        $persianNumbers = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $arabicNumbers = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
        $englishNumbers = range(0, 9);
        $text = str_replace($persianNumbers, $englishNumbers, $text);
        return str_replace($arabicNumbers, $englishNumbers, $text);
    }
}
