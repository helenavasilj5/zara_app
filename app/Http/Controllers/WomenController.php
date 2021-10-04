<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class WomenController extends Controller
{
    public function index ()
    {
        $products = Product::whereHas('Category', function($query) {
            $query->where('type', 'women');
        })->get();
        
        return view('women')->with('products', $products);
    }
}
