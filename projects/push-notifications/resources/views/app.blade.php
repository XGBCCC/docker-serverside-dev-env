<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Boxue')</title>

    <link rel="stylesheet" href="{{ mix('css/vendor.css') }}">
</head>

<body>
<div id="app">
    <header>
        @include('nav')
    </header>

    <main>
        @auth
            <router-view></router-view>
        @endauth

        @guest
            @include('login')
        @endguest
    </main>
</div>
<footer>
    <div class="mx-auto mw-100 text-center text-muted">Boxue@2019</div>
</footer>
</body>

<script src="{{ mix('js/vendor.js') }}"></script>

</html>
