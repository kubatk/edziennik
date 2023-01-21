@extends('layouts.student')

@section('content')
    <div class="contener">
        <div class="name"> Nadchodzące sprawdziany</div>
        <div class="line"></div>
        <div class="window">
            <?php
            $tests = DB::table('tests')
                ->select('tests.date', 'tests.description', 'lessons.name as lesson', 'classes.name as class')
                ->join('lessons', 'tests.lesson', '=', 'lessons.id')
                ->join('classes', 'lessons.class', '=', 'classes.id')
                ->where('classes.id', auth()->user()->class)
                ->where('tests.date', '>=', DB::raw('CAST( NOW() AS Date )'))
                ->orderBy('tests.date')
                ->get();
            $days = ['Poniedziałek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek', 'Sobota', 'Niedziela']
            ?>
            <style>th, td{
                    text-align: center;
                    width: 30vw;
                    border: 1px solid black;
                }</style>
            <table class="organizaton">
                <tr class="tableSP" style="background-color: #2d3748; color: white" >
                    <th >Data</th>
                    <th>Przedmiot</th>
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
        </div>
    </div>

@endsection
