<?php

namespace App\Repositories;

use App\Product;
use PHPHtmlParser\Dom;

class ProductRepository
{
    public function cheapest()
    {
        if ( !cache('cheapest') ) {
            cache()->put('cheapest', $this->top('ASC', 10, ''), 20);
        }
        return cache('cheapest');
    }

    public function mostExpensive()
    {
        if ( !cache('most_expensive') ) {
            cache()->put('most_expensive', $this->top('DESC', 10, '?sort=price_desc'), 20);
        }
        return cache('most_expensive');
    }

    public function top($order, $take, $url)
    {
        $this->getProductsByUrl($url);
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

    public function getProductsByUrl($url)
    {
        $products = $this->getProductsBySelector($url, '.search-results-product');

        foreach($products as $product){
            $current = [
                'name' => $product->find('h4')->find('a')[0]->text,
                'image' => $product->find('.img-responsive')->src,
                'price' => $product->find('h3')->text
            ];

            $exist = Product::where('name', $current['name'])->first();
            // Not exist
            if( !$exist->exists() ){
                // Create this one cuz is one of the top
                Product::create($current);
            }else{
                // If exist validate that is the same, cuz it could change one of its values
                if ( $exist->name != $current['name']  || $exist->image != $current['image'] || $exist->price != str_replace(array('€', '&euro;', ','),'',$current['price'])){
                    // If some of them change, it must update data
                    $exist->name = $current['name'];
                    $exist->price = $current['price'];
                    $exist->image = $current['image'];

                    $exist->save();
                }
            }
        }

        // todo Delete all no existing elements now

    }

    public function getProductsBySelector($url, $selector)
    {
        $baseUrl = 'https://www.appliancesdelivered.ie/search';
        $dom = new Dom();
        $dom->load($baseUrl.$url);
        return $dom->find($selector);
    }
}