@extends('layouts.student')

@section('content')
<h3>Obecność</h3>
<h4>
    Obecność w tygodniu
    <button onclick="prev_week()">&lt;&lt;</button>
    {{date('d-m-Y', strtotime($day))}} - {{date('d-m-Y', strtotime($day)+60*60*24*4)}}
    <button onclick="next_week()">&gt;&gt;</button>
</h4>

<?php $hours = ['7:10', '8:00', '8:50', '9:45', '10:45', '11:45', '12:40', '13:35', '14:30']; ?>
<style>th, td{border: 1px solid black}</style>
<table>
    <tr>
        <th>Godziny</th>
        <?php $day_names=['Poniedziałek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek']; ?>
        @for($i = 0; $i<5; $i++)
            <th>
                {{$day_names[$i]}}<br>
                {{date('d.m', strtotime($day)+60*60*24*$i)}}
            </th>
        @endfor
    </tr>
    @foreach($hours as $hour)
        <tr>
            <td>{{$hour}} - {{date('H:i', strtotime($hour)+45*60)}}</td>
            @for($i = 0; $i<5; $i++)
                <?php
                    $attendance = DB::table('presence')
                        ->select('lessons.name as lesson', 'presence_status.id', 'presence_status.name', 'presence_status.sign')
                        ->join('presence_status', 'presence.status', '=', 'presence_status.id')
                        ->join('timetable', 'presence.timetable', '=', 'timetable.id')
                        ->join('lessons', 'timetable.lesson', '=', 'lessons.id')
                        ->where('presence.student', '=', auth()->user()->id)
                        ->where('timetable.day', $i)
                        ->where('presence.date', date('Y-m-d', strtotime($day)+60*60*24*$i))
                        ->where('timetable.start', $hour)
                        ->get();
                ?>
                @if(count($attendance)==1)
                    <td title="{{$attendance[0]->name}}" style="text-align: center; background-color: var(--attendance-color-{{$attendance[0]->id}})">
                        <p >[{{$attendance[0]->sign}}]</p>
                        {{ucfirst($attendance[0]->lesson)}}
                    </td>
                @else
                    <td></td>
                @endif
            @endfor
        </tr>
    @endforeach
</table>


<script>
    var day = new Date('{{$day}}T00:00:00.000Z');
    function prev_week(){
        day.setDate(day.getDate() - 7);
        redirect()
    }
    function next_week(){
        day.setDate(day.getDate() + 7);
        redirect()
    }
    function redirect() {
        window.location.replace(
            '{{ route('student_attendance_with_day', ['day'=>'%d%']) }}'
                .replace('%d%', day.toISOString().split('T')[0])
        )
    }
</script>
@endsection
