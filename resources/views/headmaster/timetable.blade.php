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
    $timetable = DB::table('timetable')
        ->select('timetable.*', 'lessons.name', 'user_data.first_name', 'user_data.last_name')
        ->join('lessons', 'timetable.lesson', '=', 'lessons.id')
        ->join('user_data', 'user_data.id', '=', 'lessons.lecturer')
        ->where('lessons.class', $class->id)
        ->get();
?>

<style>th,td{border: solid 1px black; text-align: center;}</style>
<table>
    <tr>
        <th>Godziny</th>
        <th>Poniedziałek</th>
        <th>Wtorek</th>
        <th>Środa</th>
        <th>Czwartek</th>
        <th>Piątek</th>
    </tr>
    <?php $hours = ['7:10', '8:00', '8:50', '9:45', '10:45', '11:45', '12:40', '13:35', '14:30']; ?>
    <?php $empty=true; ?>

    @foreach($hours as $hour)
    <?php $start = strtotime($hour); $end = $start+45*60; ?>
        <tr>
            <td>{{ date('H:i', $start) }} - {{ date('H:i', $end) }}</td>

            @for($day=0; $day<5; $day++)
                <td>
                    <?php $empty=true ?>
                    @foreach($timetable as $l)
                        @if($l->day == $day && strtotime($l->start) == $start)
                            <?php $empty=false ?>
                            <span>{{$l->name}}</span><br>
                            <span>{{$l->first_name}} {{$l->last_name}}</span><br>
                            <button onclick="remove_lesson({{ $l->id }})">usuń</button>
                            @break
                        @endif
                    @endforeach
                    @if($empty)
                        <button onclick="add_lesson({{$day}}, '{{$hour}}')">+ dodaj</button>
                    @endif
                </td>
            @endfor
        </tr>

    @endforeach

</table>

<div id="add-to-timetable-form" style="position: absolute; top: 50%; left:40%; border: 1px black solid; width: 20%; display: none;">
    Dodaj przedmiot:
    <form method="post" action="{{ url('addTimetable') }}" >
        @csrf
        <input type="hidden" name="class" value="{{ $class->id }}">
        <input id="form-day" type="hidden" name="day" value="">
        <input id="form-hour" type="hidden" name="start_hour" value="">
        Wybierz przedmiot:
        <select name="lesson">
            @foreach($lessons as $lesson)
                <option value="{{$lesson->id}}">{{ $lesson->name }}</option>
            @endforeach

        </select>
        <button>Dodaj</button>
        <button type="button" onclick="hide_add_form()">Anuluj</button>
    </form>
</div>

<div id="remove-from-timetable-form" style="position: absolute; top: 50%; left:40%; border: 1px black solid; width: 20%; display: none;">
    Czy na pewno usunąć przedmiot?
    <form method="post" action="{{ url('removeTimetable') }}" >
        @csrf
        <input id="form-id" type="hidden" name="id" value="">
        <input id="form-class" type="hidden" name="class" value="{{$class->id}}">

        <button>Usuń</button>
        <button type="button" onclick="hide_remove_form()">Anuluj</button>
    </form>
</div>

<script>
    function add_lesson(day, hour){
        document.getElementById('form-day').value = day;
        document.getElementById('form-hour').value = hour;
        document.getElementById('add-to-timetable-form').style.display = 'block';
    }
    function hide_add_form(){
        document.getElementById('add-to-timetable-form').style.display = 'none';
    }
    function remove_lesson(id, class_id){
        document.getElementById('form-id').value = id;
        document.getElementById('remove-from-timetable-form').style.display = 'block';
    }
    function hide_remove_form(){
        document.getElementById('remove-from-timetable-form').style.display = 'none';
    }
</script>


@endsection
