@extends('layouts.teacher')

@section('content')
<h3>Nadchodzące sprawdziany:</h3>
<?php
    $tests = DB::table('tests')
        ->select('tests.date', 'tests.description', 'lessons.name as lesson', 'classes.name as class')
        ->join('lessons', 'tests.lesson', '=', 'lessons.id')
        ->join('classes', 'lessons.class', '=', 'classes.id')
        ->where('lessons.lecturer', auth()->user()->id)
        ->where('tests.date', '>=', DB::raw('CAST( NOW() AS Date )'))
        ->orderBy('tests.date')
        ->get();
    $days = ['Poniedziałek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek', 'Sobota', 'Niedziela']
?>

<table>
    <tr>
        <th>Data</th>
        <th>Klasa</th>
        <th>Opis</th>
    </tr>
    @foreach($tests as $t)

        <tr>
            <td>{{$t->date}}
            ({{$days[ date('N', strtotime($t->date))-1 ]}}):</td>
            <td><b>{{$t->class}} {{$t->lesson}}</b></td>
            <td>{{$t->description}}</td>
        </tr>
    @endforeach
</table>


<h3>Dodaj sprawdzian:</h3>
<form method="post" action="{{url('addTest')}}">
    @csrf
    <?php
        $lessons = DB::table('lessons')->select('lessons.*', 'classes.name as class_name')->join('classes', 'lessons.class', '=', 'classes.id')->where('lessons.lecturer', auth()->user()->id)->get();
    ?>
    Lekcja: <select name="lesson">
        @foreach($lessons as $l)
            <option value="{{$l->id}}">{{$l->class_name}}, {{$l->name}}</option>
        @endforeach
    </select><br>
    Data: <input name="date" type="date"><br>
    Opis: <input name="desc" type="text"><br>
    <input type="submit" value="Dodaj">
</form>

@endsection
