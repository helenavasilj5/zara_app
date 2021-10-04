<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index ()
    {
        return view('employee.products.index');
    }

    public function addProduct (Request $request)
    {
        $this->validate($request, [
            'name'        => 'required|min:2',
            'description' => 'required|min:3',
            'price'       => 'required|numeric',
            'size'        => 'required',
            'category'    => 'required',
            'image'       => 'required|image|mimes:png,jpg'
        ]);
        
        $image = $request->file('image');
        $imageName = $image->getClientOriginalName();

        $image->move('storage/', $imageName);
        
        $product = new Product();
        $product->name        = $request->input('name');
        $product->description = $request->input('description');
        $product->price       = $request->input('price');
        $product->img         = $imageName;
        $product->category_id = $request->input('category');
        $product->size        = $request->input('size');

        if ($product->save()) {
            return "OK";
        } 
        return "NO";

    }

    public function getProducts ()
    {
        return response([
            'status' => 'OK',
            'products' => Product::with('category')->get()
        ], 200);
    }

    public function updateProduct (Request $request, $id)
    {
        $this->validate($request, [
            'name'        => 'required|min:2',
            'description' => 'required|min:3',
            'price'       => 'required|numeric',
            'size'        => 'required',
            'category'    => 'required',
            'image'       => 'required|image|mimes:png,jpg'
        ]);

        if ($request->file('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $image->move('storage/', $imageName);
        }

        $product = Product::find($id);
        
        $product->name        = $request->input('name');
        $product->description = $request->input('description');
        $product->price       = $request->input('price');
        $product->img         = $imageName;
        $product->category_id = $request->input('category');
        $product->size        = $request->input('size');

        if ($product->save()) {
            return "OK";
        }
    }

    public function deleteProduct ($id)
    {
        $product = Product::find($id);
        if ($product->delete()) {
            return "OK";
        }
    }
}
