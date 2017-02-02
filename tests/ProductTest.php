<?php

use App\Product;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductTest extends TestCase
{
    use DatabaseTransactions;

    public function test_list_cheapest_products()
    {
        factory(Product::class)->times(10)->create();

        $cheapest = factory(Product::class)->create([
            'name' => 'Este es el producto mas barato',
            'price' => '50'
        ]);

        $expensive = factory(Product::class)->create([
            'name' => 'Este es el producto mas caro',
            'price' => '1001'
        ]);

        $this->visit('/')
            ->within('#cheapest-products', function() use($cheapest, $expensive){
                $this->see('Este es el producto mas barato')
                    ->see('Add to wish list')
                    ->dontSee('Este es el producto mas caro');
            });

    }

    public function test_list_more_expensive_products()
    {
        factory(Product::class)->times(10)->create();

        $cheapest = factory(Product::class)->create([
            'name' => 'Este es el producto mas barato',
            'price' => '50'
        ]);

        $expensive = factory(Product::class)->create([
            'name' => 'Este es el producto mas caro',
            'price' => '1001'
        ]);

        $this->visit('/')
            ->within('#expensive-products', function() use($cheapest, $expensive){
                $this->see('Este es el producto mas caro')
                    ->see('Add to wish list')
                    ->dontSee('Este es el producto mas barato');
            });

    }

}
