@extends('layouts.headmaster')

@section('content')
    <div class="contener">
        <br>
        <div class="columns">
            <a href="{{ route('news') }}">
                <button class="column">
                    <img src="{{ asset('assets/chat-right-text.svg') }}" alt="Ikona ogłoszeń">
                    <br>DODAJ OGŁOSZENIE
                    <i class="fa-solid fa-puzzle"></i>
                </button>
            </a>
            <a href="{{ route('manage_classes') }}">
                <button class="column">
                    <img src="{{ asset('assets/gear-wide-connected.svg') }}" alt="Ikona zarządzania klasami">
                    <br>PANEL ZARZĄDZANIA KLASAMI
                </button>
            </a>
            <a href="{{ route('manage_users') }}">
                <button class="column">
                    <img src="{{ asset('assets/person-gear.svg') }}" alt="Ikona zarządzania użytkownikami">
                    <br>PANEL ZARZĄDZANIA UŻYTKOWNIKAMI
                </button>
            </a>
        </div>
        <div class="columns">

            <a href="{{ route('add_lesson') }}">
                <button class="column">
                    <img src="{{ asset('assets/window-plus.svg') }}" alt="Ikona dodania zajęć">
                    <br>DODAJ ZAJĘCIA
                </button>
            </a>
            <a href="{{ route('add_user') }}">
                <button class="column">
                    <img src="{{ asset('assets/person-fill-add.svg') }}" alt="Ikona dodania użytkownika">
                    <br>DODAJ UŻYTKOWNIKA
                </button>
            </a>
            <a href="{{ route('add_class') }}">
                <button class="column">
                    <img src="{{ asset('assets/ui-checks-grid.svg') }}" alt="Ikona dodania klasy">
                    <br>DODAJ KLASĘ
                </button>
            </a>

        </div>
        <div class="columns">
            <a href="{{ route('messages') }}">
                <button class="column">
                    <img src="{{ asset('assets/envelope-at.svg') }}" alt="Ikona komunikatora">
                    <br>KOMUNIKATOR
                </button>
            </a>
        </div>

    </div>
@endsection
