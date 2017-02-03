<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    public function getAmountAttribute()
    {
        return '$'.$this->price/100;
    }

    public function getFavoriteClassAttribute()
    {
        if( auth()->user() ){
            return auth()->user()->isFavorite($this) ? 'glyphicon-heart' : 'glyphicon-heart-empty';
        }
        return 'glyphicon-heart-empty';
    }
}
