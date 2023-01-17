@extends('layouts.teacher')

@section('content')
<h3>
    Twój plan zajęć
</h3>

<?php
    $timetable = DB::table('timetable')
        ->select('timetable.*', 'lessons.name as lesson_name', 'classes.name as class_name')
        ->join('lessons', 'timetable.lesson', '=', 'lessons.id')
        ->join('classes', 'classes.id', '=', 'lessons.class')
        ->where('lessons.lecturer', auth()->user()->id)
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
                    @foreach($timetable as $l)
                        @if($l->day == $day && strtotime($l->start) == $start)
                            <span>{{$l->class_name}}</span><br>
                            <span>{{$l->lesson_name}}</span><br>
                            @break
                        @endif
                    @endforeach
                </td>
            @endfor
        </tr>

    @endforeach

</table>


@endsection
