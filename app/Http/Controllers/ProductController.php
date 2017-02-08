<?php

namespace App\Http\Controllers;

use App\Product;
use App\Repositories\ProductRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $products = $this->productRepository->all();
        return view('list', compact('products'));
    }

    public function favorite(Product $product)
    {
        auth()->user()->favorites()->toggle($product);

        $message = $this->successMessage(auth()->user(), $product);

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
