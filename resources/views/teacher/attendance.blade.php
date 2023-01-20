@extends('layouts.teacher')
<?php
    $classes = DB::table('classes')
        ->select('classes.id', 'classes.name')
        ->join('lessons', 'lessons.class', '=', 'classes.id')
        ->where('lessons.lecturer', \auth()->user()->id)
        ->groupBy('classes.id', 'classes.name')
        ->get();
    $statuses = DB::table('presence_status')->get();
?>
@section('content')
    <div class="contener">
        <div class="name"> FREKWENCJA </div>
        <div class="line"></div>
        <div class="window">
            <h4>
                <form id="go_to_date" class="center">
                    <img src="{{ asset('assets/chevron-left.svg') }}" title="poprzedni dzień" alt="Ikona cofnij" type="button" onclick="back()" class="svg-button">
                    <input type="date" name="date" value="{{$day}}" onchange="to_date(this)">
                    <img src="{{ asset('assets/chevron-right.svg') }}" title="następny dzień" alt="Ikona dalej" type="button" onclick="forward()" class="svg-button">
                </form>

                <form>
                    Klasa
                    <?php
                    ?>

                    <select id="class" onchange="switch_class(this)">
                        @foreach($classes as $class)
                            <option value="{{$class->id}}" @if($class->id == $class_id) selected @endif>{{$class->name}}</option>
                        @endforeach
                    </select>
                </form>
            </h4>

            <?php
            $att = DB::table('presence')
                ->select('presence.*', 'lessons.lecturer')
                ->join('timetable', 'timetable.id', '=', 'presence.timetable')
                ->join('lessons', 'timetable.lesson', '=', 'lessons.id')
                ->join('classes', 'lessons.class', '=', 'classes.id')
                ->where('lecturer', auth()->user()->id)
                ->where('date', $day)
                ->where('classes.id', $class_id)
                ->get();
            ?>

            <div class="two-column">
                <div>
                    <table >
                        <tr class="table3">
                            <th class="table3" >Uczeń</th>
                            <?php $day_number = date('N', strtotime($day)) - 1;
                            $all_lessons = DB::table('timetable')
                                ->select('timetable.*', 'lessons.name', 'lessons.lecturer')
                                ->join('lessons', 'timetable.lesson', '=', 'lessons.id')
                                ->where('lessons.class', $class_id)
                                ->where('day', $day_number)
                                ->orderBy('start')
                                ->get();
                            ?>
                            @foreach($all_lessons as $column)
                                <th class="table3">
                                    {{$column->name}}<br>
                                    {{date('H:i', strtotime($column->start))}}
                                    -
                                    {{date('H:i', strtotime($column->start)+45*60)}}

                                </th>
                            @endforeach
                        </tr>
                        <?php $students = DB::table('user_data')->where('group', 'S')->where('class', $class_id)->get(); $i=1;?>
                        @foreach($students as $student)
                            <tr class="table3">
                                <td>{{$i}}. {{$student->first_name}} {{$student->last_name}}</td>

                                    <?php $col_number=1; ?>
                                @foreach($all_lessons as $column)
                                    <td>
                                            <?php
                                            $student_attendance = DB::table('presence')
                                                ->select('presence.*', 'lessons.id as lesson_id', 'lessons.lecturer')
                                                ->join('timetable', 'timetable.id', '=', 'presence.timetable')
                                                ->join('lessons', 'timetable.lesson', '=', 'lessons.id')
                                                ->where('timetable.id', $column->id)
                                                ->where('presence.date', $day)
                                                ->where('presence.student', $student->id)
                                                ->first();
                                            ?>
                                        <select data-lesson="{{$column->id}}" data-student="{{$student->id}}" onchange="change_entry(this)"
                                                data-operation=@if($student_attendance) 'update' @else 'insert' @endif
                                        @if($column->lecturer != auth()->user()->id) disabled @endif
                                        class="rm-arrow" data-column="{{$col_number}}"
                                        >
                                        @foreach($statuses as $status)
                                            <option
                                                @if($student_attendance && $student_attendance->status == $status->id)selected @endif
                                            value="{{$status->id}}"
                                            >{{$status->sign}}</option>
                                        @endforeach
                                        <option @if(!$student_attendance)selected @endif value="0"></option>
                                        </select>
                                    </td>
                                        <?php $col_number++; ?>
                                @endforeach

                            </tr>
                                <?php $i++; ?>
                        @endforeach
                        <tr>
                            <td></td>
                            <?php $col_number = 1 ?>
                            @foreach($all_lessons as $column)
                                <td class="table3">
                                    @if($column->lecturer == auth()->user()->id)
                                        @if($col_number>1)
                                            <button class="image-button" title="Kopiuj wpisy frekwencji z poprzednich zajęć" onclick="copy_from_previous({{$col_number}})">
                                            <img class="resized-image"  src="{{ asset('assets/copy-icon.svg') }}" alt="image">
                                            </button>
                                        @endif
                                        <button class="image-button" title="Uzupełnij puste pola obecnościami" onclick="empty_to_plus({{$col_number}})">
                                            <img class="resized-image" src="{{ asset('assets/plus.svg') }}" alt="image">
                                        </button>
                                    @endif
                                </td>
                                    <?php $col_number++; ?>
                            @endforeach
                        </tr>
                    </table>

                    <button class="button2" onclick="save()">Zapisz</button>
                </div>
                <div>
                    <p>Legenda:</p>
                    <ul>
                        @foreach($statuses as $status)
                            <li><b>{{$status->sign}}</b> - {{$status->name}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>



    <form method="post" action="{{route('saveAttendance')}}" id="attendance-form">
        @csrf
        <input type="hidden" value="" name="attendance-json" id="attendance-json">
        <input type="hidden" value="{{$day}}" name="day">
        <input type="hidden" value="{{$class_id}}" name="class">
    </form>

<script>
    var class_id = {{$class_id}};
    var day = new Date('{{$day}}T00:00:00.000Z');
    function back(){
        day.setDate(day.getDate() - 1);
        redirect();
    }
    function forward(){
        day.setDate(day.getDate() + 1);
        redirect();
    }
    function to_date(select){
        // day.setDate(select.value+'T00:00:00.000Z');
        day = new Date(select.value+'T00:00:00.000Z');
        redirect();
    }
    function switch_class(sel){
        class_id = sel.value;
        redirect();
    }
    function redirect() {
        window.location.replace(
            '{{ route('teacher_attendance_with_day', ['day'=>'%d%', 'class'=>'%c%']) }}'
                .replace('%d%', day.toISOString().split('T')[0])
                .replace('%c%', class_id)
        )
    }
    var entries = [];
    function change_entry(select){
        // puste i insert = usun
        if(select.value == 0 && select.getAttribute('data-operation') == 'insert'){
            for (let i = 0; i < entries.length; i++) {
                if(entries[i]['student'] == select.getAttribute('data-student') && entries[i]['lesson'] == select.getAttribute('data-lesson')){
                    entries.splice(i, 1);
                    return
                }
            }
        }
        // zmiana a juz jest na liscie
        // zmiana a nie było na liście
        // puste i update = delete
        if(select.value == 0 && select.getAttribute('data-operation') == 'update'){
            for (let i = 0; i < entries.length; i++) {
                if(entries[i]['student'] == select.getAttribute('data-student') && entries[i]['lesson'] == select.getAttribute('data-lesson')){
                    entries.splice(i, 1);
                }
            }
            const entry = Object.create(null);
            entry['student'] = select.getAttribute('data-student');
            entry['lesson'] = select.getAttribute('data-lesson');
            entry['operation'] = 'delete';
            entries.push(entry);
            return;
        }
        for (let i = 0; i < entries.length; i++) {
            if(entries[i]['student'] == select.getAttribute('data-student') && entries[i]['lesson'] == select.getAttribute('data-lesson')){
                entries[i]['status'] = select.value;
                entries[i]['operation'] = select.getAttribute('data-operation');
                return
            }
        }
        const entry = Object.create(null);
        entry['student'] = select.getAttribute('data-student');
        entry['lesson'] = select.getAttribute('data-lesson');
        entry['operation'] = select.getAttribute('data-operation');
        entry['status'] = select.value;
        entries.push(entry);
    }

    function save(){
        if (entries.length == 0) return;

        document.getElementById('attendance-json').value = JSON.stringify(entries);
        document.getElementById('attendance-form').submit();

    }

    function empty_to_plus(column){
        var fields = document.querySelectorAll("[data-column='"+column+"']");

        fields.forEach(element => {
            if(element.value==0){
                element.value = 1;
                change_entry(element);
            }
        })
    }

    function copy_from_previous(column){
        if(column<2) return;

        var fields_to_edit = document.querySelectorAll("[data-column='"+column+"']");

        fields_to_edit.forEach(element => {
            field_to_copy = document.querySelector("[data-column='"+(column-1)+"'][data-student='"+element.getAttribute('data-student')+"']");
            element.value = field_to_copy.value;

            if(element.value!=0)change_entry(element);
        })
    }
</script>
@endsection
