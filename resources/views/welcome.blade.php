<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}"   rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">

<!-- Latest compiled and minified CSS -->
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <style>
           
            body {
                font-family: 'Nunito', sans-serif;
            }

        </style>
    </head>
    <body>
    
    <nav class="navbar">
            <div class="brand-title">
                <a href="/">WEB SHOP</a>
            </div>
            <a href="#" class="toggle-button" @click="toggleButton()">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </a>
            <div class="navbar-links">
            @if (Route::has('login'))
                <ul>
                    <li><a href="{{ route('women') }}"><i class="fa fa-female"></i>Women</a></li>
                    <li><a href="{{ route('men') }}"><i class="fa fa-male"></i>Men</a></li>
                    <li><a href="{{ route('kids') }}"><i class="fa fa-child"></i>Kids</a></li>
                    <li>
                        <a href="{{ route('product.shoppingCart') }}"><i class="fa fa-shopping-cart"></i>Cart
                        <span class="badge bg-primary rounded-pill">
                            {{ Session::has('cart') ? Session::get('cart')->totalQty : 0 }}
                        </span>
                        </a>
                    </li>
                    @auth
                        <li><a href="{{ route('user.profile') }}">Orders</a></li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->first_name }}
                            </a>
                            
                            <div class="dropdown-menu dropdown-menu-right mt-2" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" style="color:black" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @else
                        <li><a href="{{ route('login') }}"><i class="fa fa-sign-in" aria-hidden="true"></i>Login</a></li>
                    @if (Route::has('register'))
                        <li><a href="{{ route('register') }}"><i class="fa fa-sign-in" aria-hidden="true"></i>Register</a></li>
                    @endif
                    @endauth
                    
                </ul>
            @endif
            </div>
        </nav>

       <main class="content">
        @if (Request::path() == '/')
            <h3 style="text-align:center">Welcome to Web Shop</h3>
            <div>
                <img src="{{ asset('storage/bellafunk.jpg') }}" width="100%" height="500px">
            </div>
        @endif
            @yield('content')
       </main>


        <script>
            const toggleButton = document.getElementsByClassName('toggle-button')[0]
            const navbarLinks  = document.getElementsByClassName('navbar-links')[0]

            toggleButton.addEventListener('click', () => {
                navbarLinks.classList.toggle('active')
            })
        </script>
    </body>
</html>
