@extends('layouts.teacher')

@section('content')
    <div class="contener" style="padding-top: 30px">
        <div class="News">
            <div class="name" style="color: #1B2647"> AKTUALNOŚCI </div>
            <div class="line"></div>
            <div class="single_new">
                W dniu 21.02.2023 za zastępstwo za Panią Kasię zajęcia odbędą się z Panem Dyrektorem
            </div>
            <div class="single_new">
                W dniu 22.02.2023 zajęcia odwołane
            </div>
        </div>

        <div class="contener">
            <div class="columns">
                <a href="{{ route('teacher_attendance') }}">
                    <button class="column">
                        <img src="{{ asset('assets/clipboard2-check.svg') }}" alt="Ikona obetności">
                        <br>OBECNOŚĆ
                    </button>
                </a>
                <a href="">
                    <button class="column">
                        <img src="{{ asset('assets/journal-bookmark-fill.svg') }}" alt="Ikona dodania sprawdzianu">
                        <br>DODAJ SPRAWDZIAN
                    </button>
                </a>
                <a href="{{ route('teacher_marks') }}">
                    <button class="column">
                        <img src="{{ asset('assets/trophy.svg') }}" alt="Ikona ocen">
                        <br>OCENY
                    </button>
                </a>
            </div>
            <div class="columns">

                <a href="{{ route('timetable') }}">
                    <button class="column">
                        <img src="{{ asset('assets/calendar2-week.svg') }}" alt="Ikona Planu zajęć">
                        <br>PLAN ZAJĘĆ
                    </button>
                </a>
                <a href="">
                    <button class="column">
                        <img src="{{ asset('assets/envelope-at.svg') }}" alt="Ikona komunikatora">
                        <br>KOMUNIKATOR
                    </button>
                </a>
            </div>
        </div>
    </div>
@endsection
