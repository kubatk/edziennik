@extends('layouts.teacher')

@section('content')
    <div class="contener">
        <div class="name"> Twój plan zajęć </div>
        <div class="line"></div>
        <div class="window">
            <?php
            $timetable = DB::table('timetable')
                ->select('timetable.*', 'lessons.name as lesson_name', 'classes.name as class_name')
                ->join('lessons', 'timetable.lesson', '=', 'lessons.id')
                ->join('classes', 'classes.id', '=', 'lessons.class')
                ->where('lessons.lecturer', auth()->user()->id)
                ->get();
            ?>

            <table class="organizaton">
                <tr>
                    <th class="table2" style="background-color: #2d3748; color: white">Godziny</th>
                    <th class="table2" style="background-color: #2d3748; color: white">Poniedziałek</th>
                    <th class="table2" style="background-color: #2d3748; color: white">Wtorek</th>
                    <th class="table2" style="background-color: #2d3748; color: white">Środa</th>
                    <th class="table2" style="background-color: #2d3748; color: white">Czwartek</th>
                    <th class="table2" style="background-color: #2d3748; color: white">Piątek</th>
                </tr>
                <?php $hours = ['7:10', '8:00', '8:50', '9:45', '10:45', '11:45', '12:40', '13:35', '14:30']; ?>
                <?php $empty=true; ?>

                @foreach($hours as $hour)
                        <?php $start = strtotime($hour); $end = $start+45*60; ?>
                    <tr>
                        <td class="table2" style="background-color: #E38F10;">{{ date('H:i', $start) }} - {{ date('H:i', $end) }}</td>

                        @for($day=0; $day<5; $day++)
                            <td class="table2">
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

        </div>
    </div>

@endsection
