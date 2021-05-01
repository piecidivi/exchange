<?php

namespace App\Services\Manage;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Collection;

class ShowCurrencyService
{
    public function getAll(): Collection
    {
        return Currency::all();
    }

    public function getBySymbol(string $symbol): Currency
    {
        return Currency::where("symbol", "=", $symbol)->first();
    }

    public function getSymbols(): array
    {
        return Currency::all()->pluck("symbol")->toArray();
    }
}
