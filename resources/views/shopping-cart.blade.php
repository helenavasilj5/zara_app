@extends('welcome')

@section('title')
    
@endsection

@section('content')
<h3 style="text-align:center">Shopping cart</h3>
@if (Session::has('cart'))
    <div class="row">
        <div class="col-md-6 mx-auto">
            <ul class="list-group">
                @foreach ($products as $product)
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-7">
                                {{ $product['item']->name }}
                            </div>
                            <div class="col-md-1">
                            <span class="badge bg-primary rounded-pill">
                                {{ $product['qty'] }}
                            </span>
                            </div>
                            <div class="col-md-2">
                                <span>{{ $product['price'] }} KM</span>
                            </div>
                            <div class="col-md-2">
                                
                                <div class="dropdown">
                                <button class="btn btn-danger dropdown-toggle btn-sm" type="button" data-toggle="dropdown">Remove
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu list">
                                    <li>
                                        <a href="{{ route('product.reduceByOne', $product['item']->id) }}" style="color:black">
                                            Reduce one
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('product.remove', $product['item']->id) }}" style="color:black">
                                            Reduce all
                                        </a>
                                    </li>
                                </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
   
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="row">
                <div class="col-md-6 mt-4">
                    <strong>Total: {{ $totalPrice }}</strong> 
                </div>
                @auth
                <div class="col-md-6">
                    <a href="{{ route('product.checkout') }}" class="btn btn-success float-right btn-block mt-4">Checkout</a>
                </div>
                @endauth
                @guest
                <div class="col-md-6">
                    {{ Session::put('currentUrl', Request::path()) }}
                    <a href="{{ route('login') }}" class="btn btn-primary float-right btn-block mt-4">Prijava</a>
                </div>  
                @endguest
            </div>
        </div>
    </div>
    
@else
    
@endif

@endsection