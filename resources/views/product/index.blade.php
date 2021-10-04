@extends('welcome')

@section('title', 'Product')

@section('content')
  
  <div class="container">
      <div class="row">
        @foreach($products as $product)
        <div class="col-md-4">
          <div class="card mt-4">
            <img src="{{ asset('storage/'.$product->img) }}" class="card-img-top" height="300" alt="...">
            <div class="card-body">
              <h5 class="card-title">{{ $product->name }}</h5>
              <p class="card-text">{{ $product->description }}</p>
              <p class="card-text">{{ $product->price }} KM</p>
              <a href="{{ route('product.addToCart', $product->id) }}" class="btn btn-primary" onclick="return confirm('Do you want add to the item to the cart?')">
                Add to cart
              </a>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  
@endsection