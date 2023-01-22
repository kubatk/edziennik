@extends('layouts.student')

@section('content')
    <div class="contener">
        <div class="name"> Twoje Oceny </div>
        <div class="line"></div>
        <div class="window">
            <table style="display: flex; justify-content: center">
                <tr class="tableSP" style="background-color: #2d3748; color: white">
                    <th style="width: 10vw" >Przedmiot</th>
                    <th style="width: 60vw">Oceny</th>
                    <th style="width: 5vw; background-color: #1B2647">Średnia</th>
                </tr>
                <?php
                $lessons = DB::table('lessons')
                    ->select('lessons.*')
                    ->join('user_data', 'user_data.class', '=', 'lessons.class')
                    ->where('user_data.id', auth()->user()->user)
                    ->get();
                ?>
                @foreach($lessons as $l)
                    <tr>
                        <td style="text-align: center">{{ucfirst($l->name)}}</td>
                            <?php
                            $marks = DB::table('grade')
                                ->select('categories.name', 'categories.count_to_avg', 'marks.sign', 'grade.created_at', 'user_data.first_name', 'user_data.last_name', 'categories.weight')
                                ->join('marks', 'grade.mark', '=', 'marks.id')
                                ->join('categories', 'categories.id', '=', 'grade.category')
                                ->join('lessons', 'categories.lesson', '=', 'lessons.id')
                                ->join('user_data', 'user_data.id', '=', 'lessons.lecturer')
                                ->where('grade.student', auth()->user()->id)
                                ->where('categories.lesson', $l->id)
                                ->get();
                            ?>
                        <td>
                            @foreach($marks as $m)
                                {{--                        <span style="background-color: deepskyblue; padding: 3px; margin: 2px; ">{{$m->sign}}</span>--}}
                                <div class="mark-tooltip">{{$m->sign}}
                                    <span class="mark-tooltiptext">
                                <table>
                                    <tr><td><b>Opis:</b></td><td>{{$m->name}}</td></tr>
                                    <tr><td><b>Licz do średniej:</b></td><td> @if($m->count_to_avg) ✅ @else ❌ @endif</td></tr>
                                    @if($m->count_to_avg) <tr><td><b>Waga:</b></td><td>{{$m->weight}}</td></tr> @endif
                                    <tr><td><b>Nauczyciel:</b></td><td>{{$m->first_name}} {{$m->last_name}}</td></tr>
                                    <tr><td><b>Dodano:</b></td><td>{{substr($m->created_at,0,-3)}}</td></tr>
                                </table>
                            </span>
                                </div>
                            @endforeach
                        </td>
                            <?php
                            $avg = DB::select(DB::raw('SELECT SUM(m.value * c.weight)/SUM(c.weight) AS average
                                        FROM grade g
                                        JOIN marks m ON m.id = g.mark
                                        JOIN categories c ON c.id = g.category
                                        WHERE g.student = '.auth()->user()->user.'
                                        AND c.lesson = '.$l->id.'
                                        AND c.count_to_avg = 1')
                            )
                            ?>
                        <td style="background-color: #2d3748; color: white; text-align: center">{{round($avg[0]->average, 2)}}</td>
                    </tr>
                @endforeach

            </table>
        </div>
    </div>

@endsection
