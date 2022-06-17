<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function setEndonymAttribute($value)
    {
        $this->attributes['endonym'] = utf8_encode($value);
    }

    public function setOfficialNameAttribute($value)
    {
        $this->attributes['official_name'] = utf8_encode($value);
    }

}
