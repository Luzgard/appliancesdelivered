<?php

namespace App\Repositories;

use App\Product;

class ProductRepository
{
    protected $dataRepository;
    protected $selector = '.search-results-product';

    public function __construct(DataRepository $dataRepository)
    {
        $this->dataRepository = $dataRepository;
    }

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

    public function all()
    {
        if ( !cache('products') ) {
            $products = Product::all();
            cache()->put('products', $products, 20);
        }
        return cache('products');
    }

    public function top($order, $take, $url)
    {
        $this->storeProductsByUrl($url, $this->selector);
        return Product::orderBy('price', $order)->take($take)->get();
    }

    public function storeProductsByUrl($url, $selector)
    {
        $products = $this->dataRepository->getData($url, $selector);
        $this->storeProducts($products);
    }

    public function storeProducts($products)
    {
        foreach($products as $product){
            $item = [
                'name' => $product->find('h4')->find('a')[0]->text,
                'image' => $product->find('.img-responsive')->src,
                'price' => $product->find('h3')->text
            ];
            $this->storeOrUpdate($item);
        }
    }

    public function storeOrUpdate($product)
    {
        $current = Product::where('name', $product['name'])->first();
        if( !$current->exists() ){
            Product::create($product);
        }else{
            $this->dataRepository->hasChanged($current, $product);
        }
    }
}