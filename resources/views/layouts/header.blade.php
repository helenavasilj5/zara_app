<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <!--<script src="{{ asset('js/app.js') }}" defer></script>-->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}"   rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    
    <div class="content">
        <nav class="nav justify-content-end">
            <a class="nav-link disabled" href="#">{{ Auth::user()->first_name }}</a>
            <a class="nav-link" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
        </nav>
        <div class="row ml-4 mt-4">
            <div class="col-md-3">
                <ul class="list-group">
                    @can('admin-routes')
                        <li class="list-group-item">
                            <a href="{{ route('admin.index') }}">Dashboard</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('admin.users.index') }}">Users</a>
                        </li>
                    @endcan
                    @can('employee-routes')
                        <li class="list-group-item">
                            <a href="{{ route('employee.index') }}">Dashboard</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('employee.categories.index') }}">Categories</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('employee.products.index') }}">Products</a>
                        </li>
                    @endcan
                    
                </ul>
            </div>
            <div class="col-md-9">
                <main class="content">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
    
</body>
</html>