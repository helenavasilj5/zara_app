@extends('layouts.header')

@section('content')
    <div class="container">
        @include('partials.alert')
        <h3>Welcome {{ Auth::user()->first_name }}</h3><br>
        <h5>Your email: {{ Auth::user()->email }}</h5>
    </div>
   
@endsection