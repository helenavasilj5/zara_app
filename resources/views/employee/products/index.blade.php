@extends('layouts.header')


@section('content')

    <div id="app">
        <product-component></product-component>
    </div>
    
    <script src="{{ mix('js/app.js') }}"></script>
@endsection