<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        if ( !cache('products') ) {
            $products = Product::all();
            cache()->put('products', $products, 20);
        }
        $products = cache('products');

        return view('list', compact('products'));
    }

    public function favorite(Product $product)
    {
        $user = Auth::user();
        $user->favorites()->toggle($product);

        $message = $this->successMessage($user, $product);

        return back()->with('success', $message);
    }

    public function favorites(){
        $products = auth()->user()->favorites;

        return view('list', compact('products'));
    }

    public function successMessage(User $user, Product $product)
    {
        $message = 'Delete product to your wish list';

        if($user->isFavorite($product)){
            $message = 'Add product to your wish list';
        }

        return $message;
    }
}
