<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function favorite(Product $product)
    {
        $user = Auth::user();

        $user->favorites()->toggle($product);

        return back()->with('success', 'Add new product to wish list');
    }

    public function favorites(){
        $favorites = auth()->user()->favorites;

        return view('favorites', compact('favorites'));
    }
}
