<?php

namespace App\Services\Manage;

use App\Models\Currency;

class ConvertCurrencyService
{
    public function convert(Currency $cur1, Currency $cur2, string $num): array
    {
        $rate = $cur2->rate / $cur1->rate;
        $conversion = $num * $rate;
        return [$conversion, $rate];
    }
}
