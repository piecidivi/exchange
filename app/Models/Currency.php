<?php

namespace App\Models;

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
}
