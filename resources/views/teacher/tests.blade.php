@extends('layouts.teacher')

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
                ->where('lessons.lecturer', auth()->user()->id)
                ->where('tests.date', '>=', DB::raw('CAST( NOW() AS Date )'))
                ->orderBy('tests.date')
                ->get();
            $days = ['Poniedziałek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek', 'Sobota', 'Niedziela']
            ?>
            <div style="display: flex; justify-content: space-around;">
                <div class="communicator_left">
                    <table>
                        <tr class="table3" style="background-color: #1B2647; color: white">
                            <th class="table3">Data</th>
                            <th class="table3">Klasa</th>
                            <th class="table3">Opis</th>
                            <th class="table3">Akcje</th>
                        </tr>
                        @foreach($tests as $t)

                            <tr>
                                <td class="table3">{{$t->date}}
                                    ({{$days[ date('N', strtotime($t->date))-1 ]}}):</td>
                                <td class="table3"><b>{{$t->class}} {{$t->lesson}}</b></td>
                                <td class="table3">{{$t->description}}</td>
                                <td>
                                    <img class="table3 icon" src="{{ asset('assets/trash3.svg') }}"  type="button" alt="usuń" title="USUŃ WPIS">
                                </td>


                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="communicator_right">
                    <h1>Dodaj sprawdzian:</h1>
                    <form method="post" action="{{url('addTest')}}">
                        @csrf
                        <?php
                        $lessons = DB::table('lessons')->select('lessons.*', 'classes.name as class_name')->join('classes', 'lessons.class', '=', 'classes.id')->where('lessons.lecturer', auth()->user()->id)->get();
                        ?>
                        <div class="descriptionr">
                            <div class="title">Lekcja:</div>
                            <select class="input" name="lesson">
                                @foreach($lessons as $l)
                                    <option value="{{$l->id}}">{{$l->class_name}}, {{$l->name}}</option>
                                @endforeach
                            </select><br>
                        </div>
                        <div class="descriptionr">
                            <div class="title"> Data:</div>
                            <input class="input" name="date" type="date"><br>
                        </div>
                        <div class="descriptionr">
                            <div class="title"> Opis:</div>
                            <input class="input" name="desc" type="text"><br>
                        </div>

                        <input class="button2" type="submit" value="Dodaj">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
