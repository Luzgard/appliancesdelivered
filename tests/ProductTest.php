<?php

use App\Product;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductTest extends TestCase
{
    use DatabaseTransactions;

    public function test_list_cheapest_products()
    {
        factory(Product::class)->times(10)->create();

        $cheapest = factory(Product::class)->create([
            'name' => 'Cheapest product',
            'price' => '50'
        ]);

        $expensive = factory(Product::class)->create([
            'name' => 'More expensive product',
            'price' => '1001'
        ]);

        $this->visit('/')
            ->within('#cheapest-products', function() use($cheapest, $expensive){
                $this->see('Cheapest product')
                    ->dontSee('More expensive product');
            });
    }

    public function test_list_more_expensive_products()
    {
        factory(Product::class)->times(10)->create();

        $cheapest = factory(Product::class)->create([
            'name' => 'Cheapest product',
            'price' => '50'
        ]);

        $expensive = factory(Product::class)->create([
            'name' => 'More expensive product',
            'price' => '1001'
        ]);

        $this->visit('/')
            ->within('#expensive-products', function() use($cheapest, $expensive){
                $this->see('More expensive product')
                    ->dontSee('Cheapest product');
            });
    }

    public function test_list_all_products()
    {
        $product = factory(Product::class)->create([
            'name' => 'This is a product'
        ]);

        $this->visit('/')
            ->see('Products')
            ->click('Products');

        $this->seePageIs('products')
            ->see('This is a product');
    }

    public function test_see_products_title()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->visit('/')
            ->click('Products')
            ->seePageIs('products')
            ->within('#list', function ()  {
                $this->seeInElement('h3', 'Products');
            });
    }
}
