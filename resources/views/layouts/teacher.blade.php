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
    <script src="{{ mix('/js/app.js') }}"></script>
</head>
<body>
{{--    My basic dump structure, just for test. Don't be afraid to replace it--}}
    <nav style="margin: 15px 0 0 70vw; font-size: 20px;">
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            Zalogowano jako: (nauczyciel) {{ Auth::user()->name }},
                        <a class="text-decoration-underline text-blue cursor-pointer" onclick="document.getElementById('logout-form').submit();"></a>
            <button style="font-weight: 600; border: none; border-radius: 20px;background-color: #1B2647;color: white; padding: 10px 30px "> Wyloguj się </button>
        </form>
    </nav>
    <div id="teacher_app">
        <App_teacher></App_teacher>
    </div>
</body>
</html>
