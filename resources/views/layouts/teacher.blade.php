<!DOCTYPE html>
@if(auth()->user()->group != 'T')
    <script>window.location.replace('{{route('home')}}')</script>
@endif
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
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css', 'resources/css/teacher.css'])
    <script src="{{ mix('/js/app.js') }}"></script>
</head>
<body>
{{--    My basic dump structure, just for test. Don't be afraid to replace it--}}
    <nav style="margin: 15px 0 0 0; font-size: 20px; width: 100%; display: flex; justify-content: space-between">
        <div>
            <a href="{{ route('home') }}"><div class="navbarH"><span style=" color: #E38F10;line-height: 1;">E</span>DZIENNIK</div></a>
        </div>
        <div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                Zalogowano jako: {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                <a class="text-decoration-underline text-blue cursor-pointer" onclick="document.getElementById('logout-form').submit();"></a>
                <button class="log_button">Wyloguj się</button>
            </form>
        </div>
    </nav>
    <div class="Mini_menu">
        <a href="{{ route('home') }}"><button  class="menu_button" title="Główna Strona"> <img height="20px" src="{{ asset('assets/house.svg') }}" alt="Ikona główniej strony"> <p>GŁÓWNA STRONA</p></button></a>
        <a href="{{ route('teacher_attendance') }}"><button  class="menu_button" title="Obecność"> <img height="20px" src="{{ asset('assets/clipboard2-check.svg') }}" alt="Ikona obetności"> <p>OBECNOŚĆ</p></button></a>
        <a href="{{ route('teacher_tests') }}"><button class="menu_button" title="Dodaj Sprawdzian" ><img  height="20px" src="{{ asset('assets/journal-bookmark-fill.svg') }}" alt="Ikona dodania sprawdzianu"> <p>DODAJ SPRAWDZIAN</p></button></a>
        <a href="{{ route('teacher_marks') }}"><button class="menu_button" title="Oceny" ><img  height="20px" src="{{ asset('assets/trophy.svg') }}" alt="Ikona ocen"> <p>OCENY</p></button></a>
        <a href="{{ route('timetable') }}"><button class="menu_button" title="Plan zajęć" ><img  height="20px" src="{{ asset('assets/calendar2-week.svg') }}" alt="Ikona planu zjęć"> <p>PLAN ZAJĘĆ</p></button></a>
        <a href="{{ route('messages') }}"><button class="menu_button" title="Komunikator"><img height="20px" src="{{ asset('assets/envelope-at.svg') }}" alt="Ikona komunikatora"> <p>KOMUNIKATOR</p></button></a>
    </div>
    @yield('content')
{{--    <div id="teacher_app">--}}
{{--        <App_teacher></App_teacher>--}}
{{--    </div>--}}
    <div id="headmaster_app">
        <App_headmaster></App_headmaster>
    </div>
</body>
</html>
