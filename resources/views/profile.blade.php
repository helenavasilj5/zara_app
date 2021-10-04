@extends('welcome')

@section('title', 'Men')

@section('content')

<div class="content">
       <div class="row">
                <div class="col-md-8 mx-auto">
                    <h2>User profile: {{ Auth::user()->first_name }} {{Auth::user()->last_name }}</h2>
                        <hr>
                        <h2>My orders</h2>
                        @foreach ($orders as $order)
                        <div class="card">
                                <ul class="list-group list-group-flush">
                                @foreach ($order['cart']->items as $item)
                                <li class="list-group-item">
                                <h5>{{ $item['item']->name }} | Količina: {{ $item['qty'] }} |
                                Datum {{ $item['item']->created_at }}
                                <span class="badge bg-secondary float-right">
                                        {{ $item['item']->price }}KM
                                </span>
                                </h5>
                                </li>
                                @endforeach
                                </ul>
                        </div>
                        <div class="card-header">
                                <h3>
                                <span class="badge bg-secondary">
                                        Total: {{ $order['cart']->totalPrice }} KM
                                </span>
                                </h3>
                        </div>
                        <br>
                        @endforeach   
                </div>
       </div> 
</div>
@endsection