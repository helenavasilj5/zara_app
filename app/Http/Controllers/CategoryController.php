<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index ($path) 
    {
        return Category::where('type', $path)->get();
    }


}
