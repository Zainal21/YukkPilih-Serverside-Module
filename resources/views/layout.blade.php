<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yukk Pilih</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>

    <nav class="navbar navbar-expand navbar-dark bg-dark">
            <div class="container">
                <div class="navbar-brand">Yukk Pilih</div>
                <div class="navbar-nav">
                    <ul class="nav-link text-white d-flex">
                        @auth
                            <li class="nav-link"><a href="{{route('poll.index')}}" class="nav-item text-white">Polling</a></li>
                            <li class="nav-link"><a href="{{route('reset')}}" class="nav-item text-white"> Welcome {{auth()->user()->username}}</a></li>
                            <li class="nav-link"><a href="{{route('handleLogout')}}" class="nav-item text-white">Logout</a></li>
                        @endauth
                    </ul>
                </div>
            </div>
    </nav>
     @yield('content')
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
</body>
</html>