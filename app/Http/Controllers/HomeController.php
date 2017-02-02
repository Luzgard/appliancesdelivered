<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application home.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cheapest = Product::orderBy('price', 'ASC')->take(10)->get();
        $expensive= Product::orderBy('price', 'DESC')->take(10)->get();

        return view('welcome', compact('cheapest', 'expensive'));
    }
}
