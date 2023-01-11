@extends('layouts.headmaster')

@section('content')
<h3>
    Plan zajęć oddziału:
    @if (isset($class))
        {{$class->name}}
    @endif
</h3>
<h5>Zajęcia:</h5>
<?php $lessons = DB::table('lessons')
    ->join('user_data', 'lessons.lecturer', '=', 'user_data.id')
    ->where('lessons.class', $class->id)
    ->select('lessons.*', 'user_data.first_name', 'user_data.last_name')
    ->get(); ?>
@if($lessons)
<table>
    <tr>
        <th>Nazwa</th>
        <th>Prowadzący</th>
        <th>Opcje</th>
    </tr>
    @foreach($lessons as $lesson)
    <tr>
        <td>{{ $lesson->name }}</td>
        <td>{{ $lesson->first_name }} {{ $lesson->last_name }}</td>
        <td>
            <a href="#">Edytuj</a>
            <a href="#">Usuń</a>
            <a href="{{ route('add_to_timetable', ['class'=>$class->id, 'lesson'=>$lesson->id]) }}">Dodaj do planu</a>
        </td>
    </tr>
    @endforeach
</table>
@else
Brak zajęć...
@endif
<a href="{{ route('add_lesson') }}">Dodaj zajęcia</a>

<h5>Plan zajęć:</h5>
<?php
    $timetable = DB::table('timetable')->join('lessons', 'timetable.lesson', '=', 'lessons.id')->where('class', $class->id)->get();
?>
<ul>
@foreach($timetable as $l)
    <li>{{ $l->name }}: {{ $l->day }}, {{ $l->start }}</li>
@endforeach
</ul>

<style>th,td{border: solid 1px black; padding: 5px;}</style>
<table>
    <tr>
        <th>Godziny</th>
        <th>Poniedziałek</th>
        <th>Wtorek</th>
        <th>Środa</th>
        <th>Czwartek</th>
        <th>Piątek</th>
    </tr>

</table>



@endsection
