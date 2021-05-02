<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static updateOrCreate(array $array, array $array1)
 * @method static where(string $string, string $string1, string $symbol)
 */
class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        "symbol",
        "rate"
    ];

    /**
     * @throws Exception
     */
    public function convert(Currency $currency, float $amount): array
    {
        if ($this->rate === 0 || $currency->rate === 0) {
            throw new Exception("Currency rate error. Please try again.");
        }

        if ($this->symbol === $currency->symbol) {
            return [ $amount, 1];
        }

        $rate = $currency->rate / $this->rate;
        $conversion = $amount * $rate;
        return [ $conversion, $rate];
    }
}
