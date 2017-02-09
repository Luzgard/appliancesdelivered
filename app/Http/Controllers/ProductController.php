<?php

namespace App\Http\Controllers;

use App\Product;
use App\Repositories\MessageRepository;
use App\Repositories\ProductRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    protected $productRepository;
    protected $messageRepository;

    public function __construct(ProductRepository $productRepository, MessageRepository $messageRepository)
    {
        $this->productRepository = $productRepository;
        $this->messageRepository = $messageRepository;
    }

    public function index()
    {
        $products = $this->productRepository->all();
        return view('list', compact('products'));
    }

    public function favorite(Product $product)
    {
        auth()->user()->favorites()->toggle($product);
        return back()->with('success', $this->messageRepository->successMessage($product));
    }

    public function favorites(){
        $products = auth()->user()->favorites;
        return view('list', compact('products'));
    }
}
