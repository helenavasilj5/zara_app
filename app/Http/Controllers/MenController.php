<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class MenController extends Controller
{
    public function index ()
    {
        $products = Product::whereHas('Category', function($query) {
            $query->where('type', 'men');
        })->get();
        return view('men')->with('products', $products);
    }
}
