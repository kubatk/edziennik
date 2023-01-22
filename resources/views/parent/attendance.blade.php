@extends('layouts.parent')

@section('content')
<?php $child = DB::table('user_data')->where('id', auth()->user()->children)->first(); ?>
<div class="contener">
    <div class="name"> Twoja Obecność </div>
    <div class="line"></div>
    <div class="window">
        <h4 class="organizaton" style="margin-bottom: 20px">
            Obecność w tygodniu:
            <form id="go_to_date" class="center">
                <img src="{{ asset('assets/chevron-left.svg') }}" title="poprzedni dzień" alt="Ikona cofnij" type="button" onclick="prev_week()" class="svg-button">
                {{date('d-m-Y', strtotime($day))}} - {{date('d-m-Y', strtotime($day)+60*60*24*4)}}
                <img src="{{ asset('assets/chevron-right.svg') }}" title="następny dzień" alt="Ikona dalej" type="button" onclick="next_week()" class="svg-button">
            </form>
        </h4>


        <?php $hours = ['7:10', '8:00', '8:50', '9:45', '10:45', '11:45', '12:40', '13:35', '14:30']; ?>
        <style>th, td{border: 1px solid black}</style>
        <table class="organizaton" >
            <tr>
                <th class="table2" style="background-color: #2d3748; color: white" >Godziny</th>
                <?php $day_names=['Poniedziałek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek']; ?>
                @for($i = 0; $i<5; $i++)
                    <th class="table2" style="background-color: #2d3748; color: white" >
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
                                ->select('presence.id', 'lessons.name as lesson', 'presence_status.id as status', 'presence_status.name', 'presence_status.sign')
                                ->join('presence_status', 'presence.status', '=', 'presence_status.id')
                                ->join('timetable', 'presence.timetable', '=', 'timetable.id')
                                ->join('lessons', 'timetable.lesson', '=', 'lessons.id')
                                ->where('presence.student', '=', $child->id)
                                ->where('timetable.day', $i)
                                ->where('presence.date', date('Y-m-d', strtotime($day)+60*60*24*$i))
                                ->where('timetable.start', $hour)
                                ->get();
                            ?>
                        @if(count($attendance)==1)
                            <td title="{{$attendance[0]->name}}" style="text-align: center; background-color: var(--attendance-color-{{$attendance[0]->status}})">
                                [{{$attendance[0]->sign}}]<br>
                                @if($attendance[0]->status==2) <input type="checkbox" onchange="select_att(this)" data-presence="{{$attendance[0]->id}}"><br> @endif
                                {{ucfirst($attendance[0]->lesson)}}
                            </td>
                        @else
                            <td></td>
                        @endif
                    @endfor
                </tr>
            @endforeach
        </table>
        <div class="organizaton">
            <button class="organizaton button_parent" onclick="submit_checked()">Usprawiedliw zaznaczone godziny</button>
        </div>
    </div>
</div>



<form method="post" action="{{url('correctAbsence')}}" id="presence-form">
    @csrf
    <input type="hidden" name="id" id="form-id">
    <input type="hidden" name="day" value="{{$day}}">
</form>




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
            '{{ route('parent_attendance_with_day', ['day'=>'%d%']) }}'
                .replace('%d%', day.toISOString().split('T')[0])
        )
    }
    var sel_att = []
    function select_att(checkbox){
        if(checkbox.checked){
            sel_att.push(checkbox.getAttribute('data-presence'))
        }
        else{
            var index = sel_att.indexOf(checkbox.getAttribute('data-presence'));
            if (index !== -1) {
                sel_att.splice(index, 1);
            }
        }
        document.getElementById('form-id').value = sel_att.join(',');;
    }
    function submit_checked(){
        if(sel_att.length>0)
            document.getElementById('presence-form').submit();
    }
</script>
@endsection
