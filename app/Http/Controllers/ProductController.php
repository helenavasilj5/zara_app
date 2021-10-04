<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Auth;

class ProductController extends Controller
{
    
    public function getProductsByCategoryId ($category, $id)
    {
        return view('product.index')->with('products', Product::where('category_id', $id)->get());
    }

    public function getAddToCart (Request $request, $id)
    {
        $product = Product::find($id);
        
        $oldCart = Session::has('cart') ? Session::get('cart') : null;

        $cart = new Cart($oldCart);

        $cart->add($product, $product->id);
        $request->session()->put('cart', $cart);
        return redirect()->back();
    }

    public function getReduceByOne ($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduceByOne($id);

        Session::put('cart', $cart);
        return redirect()->route('product.shoppingCart');

    }

    public function getRemoveItem ($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
        
        return redirect()->route('product.shoppingCart');
    }

    public function getCart ()
    {
        if (!Session::has('cart')) {
            return view('shopping-cart')->with('products', null);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        
        return view('shopping-cart', ['products' =>  $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    public function getCheckout () 
    {
        if (!Session::has('cart')) {
            return view('shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart    = new Cart($oldCart);
        $total = $cart->totalPrice;
        return view('checkout')->with('total', $total);
    }

    public function postCheckout (Request $request)
    {
        $this->validate($request, [
            'first'   => 'required',
            'last'    => 'required',
            'email'   => 'required',
            'address' => 'required|min:5',
            'city'    => 'required|min:3',
            'state'   => 'required|min:3',
            'zip'     => 'required|integer',
        ]);
        
        if (!Session::has('cart')) {
            return redirect()->route('product.shoppingCart');
        }
        $oldCart = Session::get('cart');
        $cart    = new Cart($oldCart);

        try {
            $order = new Order();
            $order->cart    = serialize($cart);
            $order->address = $request->input('address');
            $order->city    = $request->input('city');
            $order->state   = $request->input('state');
            $order->zip     = $request->input('zip');
            
            $user = Auth::user()->orders()->save($order);
            if ($user) {
                Session::forget('cart');
                return redirect()->route('user.profile')->with('success', 'Successfully');
            }
        } catch(\Exception $e) {
            return redirect()->route('product.chechout')->with('error', $e->getMessage());
        }
    }


}
