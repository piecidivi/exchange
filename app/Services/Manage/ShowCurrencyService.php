<?php


namespace App\Services\Manage;


use App\Models\Currency;


class ShowCurrencyService
{
    public function execute(string $symbol): Currency
    {
        return Currency::where("symbol", "=", $symbol)->first();
    }
}
