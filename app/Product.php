<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    protected $fillable = [
        'name',
        'image',
        'price'
    ];


    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = str_replace(array('€', '&euro;', ','),'',$value);
    }

    public function getAmountAttribute()
    {
        return '&euro;'.number_format($this->price, 2);
    }

    public function getFavoriteClassAttribute()
    {
        if( auth()->user() ){
            return auth()->user()->isFavorite($this) ? 'glyphicon-heart' : 'glyphicon-heart-empty';
        }
        return 'glyphicon-heart-empty';
    }
}
