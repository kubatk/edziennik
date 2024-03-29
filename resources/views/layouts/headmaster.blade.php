<!DOCTYPE html>
@if(auth()->user()->group != 'H')
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
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css', 'resources/css/headmaster.css'])
    <script src="{{ mix('/js/app.js') }}"></script>
</head>
<body>
    {{--My basic dump structure, just for test. Don't be afraid to replace it--}}
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
    <div class="Mini_menu" >
        <a href="{{ route('home') }}"><button  class="menu_button" title="Główna Strona"> <img height="20px" src="{{ asset('assets/house.svg') }}" alt="Ikona główniej strony"> <p>GŁÓWNA STRONA</p></button></a>
        <a href="{{ route('manage_classes') }}"><button  class="menu_button" title="Klasy"> <img height="20px" src="{{ asset('assets/gear-wide-connected.svg') }}" alt="Ikona zarządzania klasami"> <p>KLASY</p></button></a>
        <a href="{{ route('manage_users') }}"><button class="menu_button" title="Użytkownicy" ><img  height="20px" src="{{ asset('assets/person-gear.svg') }}" alt="Ikona zarządzania użytkownikami"><p>UŻYTKOWNICY</p></button></a>
        <a href="{{ route('messages') }}"><button class="menu_button" title="Komunikator"><img height="20px" src="{{ asset('assets/envelope-at.svg') }}" alt="Ikona komunikatora"><p>KOMUNIKATOR</p></button></a>
        <a href="{{ route('news') }}"><button class="menu_button" title="Ogłoszenia"><img height="20px" src="{{ asset('assets/chat-right-text.svg') }}" alt="Ikona ogłoszeń"><p>OGŁOSZENIA</p></button></a>
        <a href="{{ route('add_lesson') }}"><button class="menu_button" title="Dodaj zajęcia"><img height="20px" src="{{ asset('assets/window-plus.svg') }}" alt="Ikona dodania zajęć"><p>DODAJ ZAJĘCIA</p></button></a>
        <a href="{{ route('add_user') }}" ><button class="menu_button" title="Dodaj Użytkownika"><img height="20px" src="{{ asset('assets/person-fill-add.svg') }}" alt="Ikona dodania użytkownika"><p>DODAJ OSOBĘ</p></button></a>
        <a href="{{ route('add_class') }}"><button  class="menu_button" title="Dodaj Klasę"><img height="20px" src="{{ asset('assets/ui-checks-grid.svg') }}" alt="Ikona dodania klasy"><p>DODAJ KLASĘ</p></button></a>
    </div>
    @yield('content')

    <div id="headmaster_app">
        <App_headmaster></App_headmaster>
    </div>

</body>
</html>
