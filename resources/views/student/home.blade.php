@extends('layouts.student')

@section('content')
    <div class="contener">
        <div class="News">
            <div class="name" style="color: #1B2647"> AKTUALNOŚCI </div>
            <div class="line" style="margin-bottom: 20px"></div>
            <div class="news_page" >
                <?php $news = DB::table('news')
                    ->select('news.*', 'user_data.first_name', 'user_data.last_name')
                    ->join('user_data', 'added_by', '=', 'user_data.id')
                    ->orderBy('news.id', 'DESC')
                    ->get(); ?>
                @foreach($news as $n)
                    <div class="single_new">
                        {{$n->content}}
                        <div class="descryption_news">
                            Dodane przez: {{$n->first_name}} {{$n->last_name}} dnia: {{$n->created_at}} </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="contener">

            <div class="columns">
                <a href="{{ route('student_marks') }}">
                    <button class="column">
                        <img src="{{ asset('assets/trophy.svg') }}" alt="Ikona ocen">
                        <br>OCENY
                    </button>
                </a>
                <a href="{{ route('student_tests') }}">
                    <button class="column">
                        <img src="{{ asset('assets/journal-bookmark-fill.svg') }}" alt="Ikona sprawdzianów">
                        <br>SPRAWDZIANY
                    </button>
                </a>
                <a href="{{ route('student_attendance') }}">
                    <button class="column">
                        <img src="{{ asset('assets/clipboard2-check.svg') }}" alt="Ikona obecności">
                        <br>OBECNOŚCI
                    </button>
                </a>
            </div>
            <div class="columns">
                <a href="{{ route('timetable') }}">
                    <button class="column">
                        <img src="{{ asset('assets/calendar2-week.svg') }}" alt="Ikona plan zajęć">
                        <br>PLAN ZAJĘĆ
                    </button>
                </a>
                <a href="{{ route('messages') }}">
                    <button class="column">
                        <img src="{{ asset('assets/envelope-at.svg') }}" alt="Ikona komunikatora">
                        <br>KOMUNIKATOR
                    </button>
                </a>
            </div>
        </div>
    </div>
@endsection
