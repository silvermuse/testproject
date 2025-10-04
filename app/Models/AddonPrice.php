<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddonPrice extends Model
{
    protected $fillable = ['type', 'price', 'applicable_sizes'];

    public static function getPrices()
    {
        return self::pluck('price', 'type')->toArray();
    }

    public static function getAddonForSize($addonType, $size)
    {
 
        if ($addonType === 'pepperoni') {
            return self::where('type', 'pepperoni_' . $size)
                ->where(function ($query) use ($size) {
                    $query->whereNull('applicable_sizes')
                        ->orWhereRaw("FIND_IN_SET(?, applicable_sizes)", [$size]);
                })
                ->first();
        }
        
        return self::where('type', $addonType)
            ->where(function ($query) use ($size) {
                $query->whereNull('applicable_sizes')
                    ->orWhereRaw("FIND_IN_SET(?, applicable_sizes)", [$size]);
            })
            ->first();
    }
}
