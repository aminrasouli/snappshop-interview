<?php

namespace Tests\Unit;

use App\Services\TextService;
use Tests\TestCase;

class TextServiceTest extends TestCase
{
    public function testToEnglishNumber()
    {
        $textService = new TextService();

        $persianText = '۰۱۲۳۴۵۶۷۸۹';
        $expectedPersianResult = '0123456789';

        $arabicText = '٠١٢٣٤٥٦٧٨٩';
        $expectedArabicResult = '0123456789';

        $resultPersian = $textService->toEnglishNumber($persianText);
        $resultArabic = $textService->toEnglishNumber($arabicText);

        $this->assertEquals($expectedPersianResult, $resultPersian);
        $this->assertEquals($expectedArabicResult, $resultArabic);
    }

}
