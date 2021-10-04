@extends('layouts.header')

@section('content')

<div class="container">
    @include('partials.alert')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h3>Welcome {{ Auth::user()->first_name }}</h3><br>
                    <h5>Your email: {{ Auth::user()->email }}</h5>
                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
   
@endsection