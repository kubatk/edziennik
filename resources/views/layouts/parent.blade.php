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
    {{--My basic dump structure, just for test. Don't be afraid to replace it--}}
    <nav>
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            Zalogowano jako: (rodzic) {{ Auth::user()->first_name }} {{ Auth::user()->last_name }},
            {{--            <a class="text-decoration-underline text-blue cursor-pointer" onclick="document.getElementById('logout-form').submit();">[Wyloguj]</a>--}}
            <button>[Wyloguj się]</button>
        </form>
    </nav>

    <div>@yield('content')</div>
</body>
</html>
