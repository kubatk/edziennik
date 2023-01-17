@extends('layouts.headmaster')

@section('content')
    <div class="contener" id="popup_background">
        <div class="name"> Plan zajęć oddziału:
            @if (isset($class))
                {{$class->name}}
            @endif
        </div>
        <div class="line"></div>
        <div class="window">
            <h5 class="title3">Zajęcia:</h5>
            <?php $lessons = DB::table('lessons')
                ->join('user_data', 'lessons.lecturer', '=', 'user_data.id')
                ->where('lessons.class', $class->id)
                ->select('lessons.*', 'user_data.first_name', 'user_data.last_name')
                ->get(); ?>
            @if($lessons)
                <table>
                    <tr>
                        <th class="table1" style="background-color: #2d3748; color: white">Nazwa</th>
                        <th class="table1" style="background-color: #2d3748; color: white">Prowadzący</th>
                        <th class="table1" style="background-color: #2d3748; color: white">Opcje</th>
                    </tr>
                    @foreach($lessons as $lesson)
                        <tr>
                            <td class="table1">{{ $lesson->name }}</td>
                            <td class="table1">{{ $lesson->first_name }} {{ $lesson->last_name }}</td>
                            <td class="EDbutton">
                                <a class="button3" href="#">Edytuj</a>
                                <a class="button3" href="#">Usuń</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            @else
                Brak zajęć...
            @endif
            <div style="margin: 20px">
                <a class="button2" target="_blank" href="{{ route('add_lesson') }}">Dodaj zajęcia</a>
            </div>


            <h5 class="title3">Plan zajęć:</h5>
            <?php
            $timetable = DB::table('timetable')
                ->select('timetable.*', 'lessons.name', 'user_data.first_name', 'user_data.last_name')
                ->join('lessons', 'timetable.lesson', '=', 'lessons.id')
                ->join('user_data', 'user_data.id', '=', 'lessons.lecturer')
                ->where('lessons.class', $class->id)
                ->get();
            ?>

            <style>th,td{border: solid 1px black; text-align: center;}</style>
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
                                    <?php $empty=true ?>
                                @foreach($timetable as $l)
                                    @if($l->day == $day && strtotime($l->start) == $start)
                                            <?php $empty=false ?>
                                        <span>{{$l->name}}</span><br>
                                        <span>{{$l->first_name}} {{$l->last_name}}</span><br>
                                        <img src="{{ asset('assets/minus.svg') }}" alt="Ikona minusa" onclick="remove_lesson({{ $l->id }})" class="buttonAD">
                                        @break
                                    @endif
                                @endforeach
                                @if($empty)
                                    <img src="{{ asset('assets/plus.svg') }}" alt="Ikona plusa" onclick="add_lesson({{$day}}, '{{$hour}}')" class="buttonAD">
                                @endif
                            </td>
                        @endfor
                    </tr>

                @endforeach

            </table>
        </div>
    </div>
            <div id="add-to-timetable-form" class="form-popup">
                Dodaj przedmiot:
                <form class="inside_popup_containter" method="post" action="{{ url('addTimetable') }}" >
                    @csrf
                    <input type="hidden" name="class" value="{{ $class->id }}">
                    <input id="form-day" type="hidden" name="day" value="">
                    <input id="form-hour" type="hidden" name="start_hour" value="">
                    Wybierz przedmiot:
                    <select name="lesson">
                        @foreach($lessons as $lesson)
                            <option value="{{$lesson->id}}">{{ $lesson->name }}</option>
                        @endforeach

                    </select>
                    <button class="buttonAD" >Dodaj</button>
                    <button class="buttonAD" type="button" onclick="hide_add_form()">Anuluj</button>
                </form>
            </div>

            <div id="remove-from-timetable-form" class="form-popup">
                Czy na pewno usunąć przedmiot?
                <form class="inside_popup_containter" method="post" action="{{ url('removeTimetable') }}" >
                    @csrf
                    <input id="form-id" type="hidden" name="id" value="">
                    <input id="form-class" type="hidden" name="class" value="{{$class->id}}">

                    <button class="buttonAD" >Usuń</button>
                    <button class="buttonAD" type="button" onclick="hide_remove_form()">Anuluj</button>
                </form>
            </div>



<script>
    function add_lesson(day, hour){
        document.getElementById('form-day').value = day;
        document.getElementById('form-hour').value = hour;
        document.getElementById('add-to-timetable-form').style.display = 'block';
        document.getElementById('popup_background').classList.add("blur-background");
    }
    function hide_add_form(){
        document.getElementById('add-to-timetable-form').style.display = 'none';
        document.getElementById('popup_background').classList.remove("blur-background");
    }
    function remove_lesson(id, class_id){
        document.getElementById('form-id').value = id;
        document.getElementById('remove-from-timetable-form').style.display = 'block';
        document.getElementById('popup_background').classList.add("blur-background");
    }
    function hide_remove_form(){
        document.getElementById('remove-from-timetable-form').style.display = 'none';
        document.getElementById('popup_background').classList.remove("blur-background");
    }
</script>


@endsection
