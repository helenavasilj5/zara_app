<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function getProfile ()
    {
        try {
            $orders = Auth::user()->orders;
            $orders->transform(function ($order, $key) {
                $order->cart = unserialize($order->cart);
                return $order;
            });
            
            return view('profile')->with('orders', $orders);
        } catch (\Exception $e) {
            return view('profile')->with('error', $e->getMessage());
        }        
    }
}
