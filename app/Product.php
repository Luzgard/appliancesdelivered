<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function getAmountAttribute()
    {
        return '$'.$this->price/100;
    }
}
