@extends('layouts.teacher')

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
