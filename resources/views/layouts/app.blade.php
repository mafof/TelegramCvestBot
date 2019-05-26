<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title : "Главная страница" }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <nav class="nav-main">
        <i class="fas fa-bars bars" id="bars" onclick="setBars()"></i>
        <div class="nav-parts">
            <a href="{{ route('home') }}" class="nav-link">Главная</a>
            <a href="{{ route('about') }}" class="nav-link">О проекте</a>

            @guest
                <a href="{{ route('login') }}" class="nav-link user user-part"><i class="fas fa-sign-in-alt icons"></i>Вход</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="nav-link user-part"><i class="fas fa-user-plus icons"></i>Регистрация</a>
                @endif
            @else
                <a href="#" class="nav-link user dropdown" id="nickname" onclick="setNickname()">{{ Auth::user()->nickname }}</a>
                <div class="user-form">
                    <a href="#" class="nav-link dropdown">Создать квест</a>
                    <a href="{{ route('logout') }}" class="nav-link dropdown"
                       onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                        Выйти
                    </a>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @endguest
        </div>
    </nav>
    <main class="py-4">
        @yield('content')
    </main>
    <script>
        function setBars() {
            let display = document.getElementsByClassName('nav-parts')[0].style.display;
            document.getElementsByClassName('nav-parts')[0].style.display = (display === "flex") ? "none" : "flex";
        }

        function setNickname() {
            let display = document.getElementsByClassName('user-form')[0].style.display;
            console.log(display);
            document.getElementsByClassName('user-form')[0].style.display = (display === "none" || display === "") ? "inherit" : "none";
        }
    </script>
</body>
</html>
