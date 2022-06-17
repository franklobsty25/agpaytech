<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        'iso_code',
        'iso_numeric_code',
        'common_name',
        'official_name',
        'symbol',
    ];

    public function setSymbolAttribute($value)
    {
        $this->attributes['symbol'] = utf8_encode($value);
    }

    public function getSymbolAttribute($symbol)
    {
        return Str::of($symbol)->trim();
    }
}
