<?php

use App\Product;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WishListTest extends TestCase
{
    use DatabaseTransactions;

    public function test_select_product_to_wish_list()
    {
        $product = factory(Product::class)->create([
            'name' => 'This is one of my favorites'
        ]);

        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->visit('/')
            ->within('#expensive-products', function () use ($user) {
                $this->click('favorite-icon');
            });

        $this->seeInDatabase('favorites', [
            'user_id' => $user->id,
            'product_id' => $product->id
        ]);
    }

    public function test_deselect_product_to_wish_list()
    {
        $product = factory(Product::class)->create([
            'name' => 'This was one of my favorites'
        ]);

        $user = factory(User::class)->create();

        $user->favorites()->toggle($product);

        $this->seeInDatabase('favorites',[
            'user_id' => $user->id,
            'product_id' => $product->id
        ]);

        $this->actingAs($user)
            ->visit('/')
            ->within('#expensive-products', function() use($user){
                $this->click('favorite-icon');
            });

        $this->dontSeeInDatabase('favorites',[
            'user_id' => $user->id,
            'product_id' => $product->id
        ]);
    }

    public function test_heart_icon_change_if_is_favorite()
    {
        $product = factory(Product::class)->create([
            'name' => 'This was one of my favorites'
        ]);

        $user = factory(User::class)->create();

        $user->favorites()->toggle($product);

        $this->actingAs($user)
            ->visit('/')
            ->within('#expensive-products', function () use ($user) {
                $this->see('glyphicon-heart');
            });
    }

    public function test_if_not_auth_user_always_shows_heart_empty()
    {
        factory(Product::class)->create([
            'name' => 'This was one of my favorites'
        ]);

        $this->visit('/')
            ->within('#expensive-products', function ()  {
                $this->see('glyphicon-heart-empty');
            });
    }

    public function test_when_not_logged_user_click_on_wish_list_icon_redirect_to_login_view()
    {
        factory(Product::class)->create([
            'name' => 'This is one of my favorites'
        ]);

        $this->visit('/')
            ->within('#expensive-products', function ()  {
                $this->click('favorite-icon');
            });

        $this->seePageIs('/login');
    }

    public function test_show_favorites_list()
    {
        $product = factory(Product::class)->create([
            'name' => 'This is one of my favorites'
        ]);

        $otherProduct = factory(Product::class)->create([
            'name' => 'This is no one of my favorites'
        ]);

        $user = factory(User::class)->create();

        $user->favorites()->toggle($product);

        $this->actingAs($user)
            ->visit('/')
            ->click('Favorites')
            ->seePageIs('favorites')
            ->see('This is one of my favorites')
            ->dontSee('This is no one of my favorites');
    }

    public function test_see_favorite_title()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->visit('/')
            ->click('Favorites')
            ->seePageIs('favorites')
            ->within('#list', function ()  {
                $this->seeInElement('h3', 'Favorites');
            });
    }

}
