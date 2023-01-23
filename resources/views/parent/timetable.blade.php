@extends('layouts.parent')

    <div class="contener">
        <div class="name"> Plan zajęć dziecka</div>
        <div class="line"></div>
        <div class="window">
            <?php
            @section('content')
            <?php $child = DB::table('user_data')->where('id', auth()->user()->children)->first(); ?>
            $timetable = DB::table('timetable')
                ->select('timetable.*', 'lessons.name as lesson_name', DB::raw('CONCAT(user_data.first_name, " ", user_data.last_name) as lecturer'))
                ->join('lessons', 'timetable.lesson', '=', 'lessons.id')
                ->join('classes', 'classes.id', '=', 'lessons.class')
                ->join('user_data', 'user_data.id', '=', 'lessons.lecturer')
                ->where('lessons.class', $child->class)
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

                @foreach($hours as $hour)
                        <?php $start = strtotime($hour); $end = $start+45*60; ?>
                    <tr>
                        <td class="table2" style="background-color: #E38F10;">{{ date('H:i', $start) }} - {{ date('H:i', $end) }}</td>

                        @for($day=0; $day<5; $day++)
                            <td class="table2">
                                @foreach($timetable as $l)
                                    @if($l->day == $day && strtotime($l->start) == $start)
                                        <span>{{ucfirst($l->lesson_name)}}</span><br>
                                        <span>{{$l->lecturer}}</span><br>
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
