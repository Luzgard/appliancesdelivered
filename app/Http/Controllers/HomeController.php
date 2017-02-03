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
        if ( ! (cache('cheapest') ||  cache('expensive')) ) {
            $cheapest = Product::orderBy('price', 'ASC')->take(10)->get();
            $expensive= Product::orderBy('price', 'DESC')->take(10)->get();
            cache()->put('cheapest', $cheapest, 20);
            cache()->put('expensive', $expensive, 20);
        }

        $cheapest = cache('cheapest');
        $expensive= cache('expensive');

        return view('welcome', compact('cheapest', 'expensive'));
    }
}
