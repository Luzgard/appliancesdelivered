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
            'price' => '50'
        ]);

        $expensive = factory(Product::class)->create([
            'price' => '1001'
        ]);

        $this->visit('/')
            ->within('.cheapest-products', function() use($cheapest, $expensive){
                $this->see($cheapest->name)
                    ->link('Add to wish list')
                    ->dontSee($expensive->name);
            });

    }
}
