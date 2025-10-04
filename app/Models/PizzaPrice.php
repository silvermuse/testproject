<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PizzaPrice extends Model
{
    protected $fillable = ['size', 'price'];

    public static function getPrices()
    {
        return self::pluck('price', 'size')->toArray();
    }
}
