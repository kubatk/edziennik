<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @viteReactRefresh
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<nav style="margin: 15px 0 0 70vw; font-size: 20px;">
    <form id="logout-form" action="{{ route('logout') }}" method="POST">
        @csrf
        Zalogowano jako: (Rodzic) {{ Auth::user()->first_name }} {{ Auth::user()->last_name }},
        <a class="text-decoration-underline text-blue cursor-pointer" onclick="document.getElementById('logout-form').submit();"></a>
        <button style="font-weight: 600; border: none; border-radius: 20px;background-color: #1B2647;color: white; padding: 10px 30px ">Wyloguj się</button>
    </form>
</nav>
<div id="parent_app">
    <App_parent></App_parent>
</div>
</body>
</html>
