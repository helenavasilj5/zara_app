<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class KidsController extends Controller
{
    public function index ()
    {
        $products = Product::whereHas('Category', function($query) {
            $query->where('type', 'kids');
        })->get();
        return view('kids')->with('products', $products);
        return view('kids');
    }
}
