<?php

namespace App\Services\Manage;

use App\Models\Currency;
use Exception;

class ConvertCurrencyService
{
    /**
     * @throws \Exception
     */
    public function convert(Currency $cur1, Currency $cur2, string $num): array
    {
        try {
            return $cur1->convert($cur2, $num);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}
