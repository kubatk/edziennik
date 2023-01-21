<!DOCTYPE html>
@if(auth()->user()->group != 'S')
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
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css', 'resources/css/mark_tooltip.css', 'resources/css/student.css'])
    <script src="{{ mix('/js/app.js') }}"></script>
</head>
<body>
{{--My basic dump structure, just for test. Don't be afraid to replace it--}}
<a href="{{ route('home') }}"><div class="navbarH"><span style=" color: #E38F10;line-height: 1;">E</span>DZIENNIK</div></a>
<nav style="margin: 15px 0 0 70vw; font-size: 20px;">
    <form id="logout-form" action="{{ route('logout') }}" method="POST">
        @csrf
        Zalogowano jako: (uczeń) {{ Auth::user()->first_name }} {{ Auth::user()->last_name }},
        <a class="text-decoration-underline text-blue cursor-pointer" onclick="document.getElementById('logout-form').submit();"></a>
        <button style="margin-bottom:20px; font-weight: 600; border: none; border-radius: 20px;background-color: #1B2647;color: white; padding: 10px 30px "> Wyloguj się </button>
    </form>
</nav>

<div class="Mini_menu" >
    <a href="{{ route('home') }}"><button  class="menu_button" title="Główna Strona"> <img height="20px" src="{{ asset('assets/house.svg') }}" alt="Ikona główniej strony"> <p>GŁÓWNA STRONA</p></button></a>
    <a href="{{ route('student_marks') }}"><button  class="menu_button" title="Oceny"> <img height="20px" src="{{ asset('assets/trophy.svg') }}" alt="Ikona ocen"><p>OCENY</p></button></a>
    <a href="{{ route('student_tests') }}"><button class="menu_button" title="Sprawdziany" ><img  height="20px" src="{{ asset('assets/journal-bookmark-fill.svg') }}" alt="Ikona sprawdzianu"><p>SPRAWDZIANY</p></button></a>
    <a href="{{ route('student_attendance') }}"><button class="menu_button" title="Obecności" ><img  height="20px" src="{{ asset('assets/clipboard2-check.svg') }}" alt="Ikona obecności"><p>OBECNOŚCI</p></button></a>
    <a href="{{ route('timetable') }}"><button class="menu_button" title="Plan Zajęć" ><img  height="20px" src="{{ asset('assets/calendar2-week.svg') }}" alt="Ikona planu zajęć"><p>PLAN ZAJĘĆ</p></button></a>
    <a href="{{ route('messages') }}"><button class="menu_button" title="Komunikator"><img height="20px" src="{{ asset('assets/envelope-at.svg') }}" alt="Ikona komunikatora"><p>KOMUNIKATOR</p></button></a>

</div>
@yield('content')
{{--<div id="student_app">--}}
{{--    <App_student></App_student>--}}
{{--</div>--}}
<div id="headmaster_app">
    <App_headmaster></App_headmaster>

</div>
</body>
</html>
