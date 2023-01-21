@extends('layouts.parent')

@section('content')
<?php $child = DB::table('user_data')->where('id', auth()->user()->children)->first(); ?>
<h3>Nadchodzące sprawdziany:</h3>
<?php
    $tests = DB::table('tests')
        ->select('tests.date', 'tests.description', 'lessons.name as lesson', 'classes.name as class')
        ->join('lessons', 'tests.lesson', '=', 'lessons.id')
        ->join('classes', 'lessons.class', '=', 'classes.id')
        ->where('classes.id', $child->class)
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
            <td><b>{{$t->lesson}}</b></td>
            <td>{{$t->description}}</td>
        </tr>
    @endforeach
</table>

@endsection
