<?php

namespace App\Repositories;

use App\Product;

class ProductRepository
{

    public function cheapest()
    {
        if ( !cache('cheapest') ) {
            cache()->put('cheapest', $this->top('ASC', 10), 20);
        }
        return cache('cheapest');
    }

    public function expensive()
    {
        if ( !cache('expensive') ) {
            cache()->put('expensive', $this->top('DESC', 10), 20);
        }
        return cache('expensive');
    }

    public function top($order, $take)
    {
        return Product::orderBy('price', $order)->take($take)->get();
    }

    public function all()
    {
        if ( !cache('products') ) {
            $products = Product::all();
            cache()->put('products', $products, 20);
        }
        return cache('products');
    }
}