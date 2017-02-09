<?php

namespace App\Repositories;

use App\Product;

class MessageRepository
{
    public function successMessage(Product $product)
    {
        $message = 'Delete product to your wish list';

        if(auth()->user()->isFavorite($product)){
            $message = 'Add product to your wish list';
        }

        return $message;
    }

}