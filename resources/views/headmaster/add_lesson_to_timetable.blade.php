@extends('layouts.headmaster')

@section('content')
<h3>
    Dodawanie zajęć {{$lesson->name}} do planu klasy {{ $class->name }}
</h3>
<form method="post" action="{{ url('addTimetable') }}" >
    @csrf
    <input type="hidden" name="class" value="{{$class->id}}">
    <input type="hidden" name="lesson" value="{{$lesson->id}}">
    Dzień tygodnia:
    <select name="day">
        <?php $days = ['Poniedziałek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek'] ?>
        @for($i=0; $i<5; $i++)
            <option value="{{$i}}">{{$days[$i]}}</option>
        @endfor
    </select><br>


    Godzina rozpoczęcia:
    <input type="time" name="start_hour"><br>
    Długość zajęć:
    <input type="text" name="duration" value="45"> minut<br>
    <input type="submit" value="Dodaj">
</form>
@endsection
