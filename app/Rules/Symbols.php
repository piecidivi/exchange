<?php

namespace App\Rules;

use App\Services\Manage\ShowCurrencyService;
use Illuminate\Contracts\Validation\Rule;

class Symbols implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $symbols = (new ShowCurrencyService)->getSymbols();
        return in_array($value, $symbols);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'Requested currency does not exist.';
    }
}
