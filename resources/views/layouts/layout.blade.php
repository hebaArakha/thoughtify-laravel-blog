<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thoughtify</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/showarticle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pagination.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <nav class="navbar bg-dark bg-opacity-10 ">
        <div class="container justify-content-between flex-column flex-md-row">
            <a class="navbar-brand" href="{{ route('home.index') }}"><b><i>Thoughtify</i></b></a>
            @guest()
                <div class="d-flex">
                    <a class="btn btn-dark  mx-2" href="{{ route('register') }}">Sign Up</a>
                    <a class="btn btn-success  mx-2" href="{{ route('login') }}">Login</a>
                </div>
            @endguest
            @auth
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-dark  mx-2">Logout</button>
                </form>
            @endauth
        </div>
    </nav>

    @yield('content')
    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('js/showarticle.js') }}"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>

</body>

</html>
