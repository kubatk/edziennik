@extends('layouts.teacher')

@section('content')

    <div class="contener" id="popup_background">
        <div class="name">
            <form>
                OCENY
                <br>
                <?php
                $current_lesson=null;
                $lessons = DB::table('lessons')
                    ->select('lessons.*', 'classes.name as classname', 'classes.id as classid')
                    ->join('classes', 'lessons.class', '=', 'classes.id')
                    ->where('lecturer', auth()->user()->id)
                    ->get(); ?>
                <div class="choose_class">
                    Klasa:
                    <select class="choose_class_select" id="lesson" onchange="redirect(this)">

                        @foreach($lessons as $lesson)
                                <?php if($lesson->id == $lesson_id) $current_lesson = $lesson; ?>
                            <option value="{{$lesson->id}}" @if($lesson->id == $lesson_id) selected @endif>{{$lesson->classname}}, {{$lesson->name}}</option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
        <div class="line"></div>
        <div class="window">

            <button class="button2" onclick="show_cat_form()">Dodaj kategorię ocen</button>
            <?php
            $students = DB::table('user_data')->where('group', 'S')->where('class', $current_lesson->classid)->get();
            $categories = DB::table('categories')->where('lesson', $current_lesson->id)->get();
            $valid_marks = DB::table('marks')->get();
            ?>
            <style>th,td{border: solid 1px black;}</style>
            <h5>INFO: Akceptowane oceny, to oceny w skali 1-6. Każda ocena może posiadać znak + i -. Oprócz tego akceptowane są: 0, np i bz.</h5>

            <table class="organizaton">
                <tr>
                    <th>Uczeń</th>
                    @foreach($categories as $category)
                        <th style="width: 55px; word-wrap: break-word; transform: rotate(-180deg); writing-mode: vertical-rl; text-orientation: sideways; height: min-content">{{$category->name}}</th>
                    @endforeach
                    <th style="width: auto;"></th>
                    <th>Średnia</th>
                </tr>
                <?php $i=1; ?>
                @foreach($students as $student)
                    <tr>
                        <td  style="padding: 5px; color: white; background-color: #E38F10"  >{{$i}}. {{$student->first_name}} {{$student->last_name}}</td>
                        @foreach($categories as $category)
                            <td>
                                <input
                                    style=" width: 50px; text-align: center; margin: 2px;"
                                    <?php $mark = DB::table('grade')->join('marks', 'grade.mark', '=', 'marks.id')->where('student', $student->id)->where('category', $category->id)->first(); ?>
                                    value="@if($mark){{$mark->sign}}@endif"
                                    data-cat="{{$category->id}}" data-student="{{$student->id}}"
                                    data-operation="@if($mark){{'update'}}@else{{'insert'}}@endif"
                                    onchange="mark_edited(this)"
                                >
                            </td>
                        @endforeach
                        @if($i==1)
                            <td rowspan="{{count($students)}}" class="marks_place"></td>
                        @endif
                            <?php
                            $avg = DB::select(DB::raw('SELECT SUM(m.value * c.weight)/SUM(c.weight) AS average
                                        FROM grade g
                                        JOIN marks m ON m.id = g.mark
                                        JOIN categories c ON c.id = g.category
                                        WHERE g.student = '.$student->id.'
                                        AND c.lesson = '.$current_lesson->id.'
                                        AND c.count_to_avg = 1')
                            )
                            ?>
                        <td>{{round($avg[0]->average, 2)}}</td>
                    </tr>
                        <?php $i++; ?>
                @endforeach
            </table>
            <button class="button2" onclick="save_marks()">Zapisz oceny</button>

        </div>
    </div>




<div id="add-category-form" class="form-popup">
    Dodaj kategorię:
    <form method="post" action="{{ url('addMarkCategory') }}" >
        @csrf
        <input type="hidden" name="lesson" value="{{$current_lesson->id}}">

        Nazwa: <br><input type="text" name="name"><br>
        Waga: <br><input type="number" name="weight" value="1"><br>
        Licz do średniej: <input type="checkbox" name="average" checked><br>

        <button class="buttonAD" >Dodaj</button>
        <button class="buttonAD" type="reset" onclick="hide_cat_form()">Anuluj</button>
    </form>
</div>


<form method="post" action="{{ url('saveMarks') }}" id="marks-form">
    @csrf
    <input type="hidden" name="marks-json" id="marks-json">
    <input type="hidden" name="lesson" value="{{$current_lesson->id}}">
</form>

<script>
    function redirect(sel) {
        window.location.replace('{{ route('teacher_marks', '') }}/'+sel.value);
    }
    function show_cat_form(){
        document.getElementById('add-category-form').style.display = 'block';
        document.getElementById('popup_background').classList.add("blur-background");
    }
    function hide_cat_form(){
        document.getElementById('add-category-form').style.display = 'none';
        document.getElementById('popup_background').classList.remove("blur-background");
    }
    var marks=[];
    var valid_marks = {
        @foreach($valid_marks as $m)
        '{{$m->sign}}': {{$m->id}},
        @endforeach
    }
    function mark_edited(input){
        if(input.value == '' && input.getAttribute('data-operation')=='insert'){
            input.style.backgroundColor = 'white';
            for (let i = 0; i < marks.length; i++) {
                if(marks[i]['student'] == input.getAttribute('data-student') && marks[i]['category'] == input.getAttribute('data-cat')){
                    marks.splice(i, 1);
                    return
                }
            }
            return;
        }
        if(input.value == '' && input.getAttribute('data-operation')=='update'){
            input.style.backgroundColor = 'lightblue';
            const mark = Object.create(null);
            mark['student'] = input.getAttribute('data-student');
            mark['category'] = input.getAttribute('data-cat');
            mark['operation'] = 'delete';
            marks.push(mark);
            return
        }
        if(! (input.value in valid_marks)){
            input.style.backgroundColor = 'lightcoral';
            for (let i = 0; i < marks.length; i++) {
                if(marks[i]['student'] == input.getAttribute('data-student') && marks[i]['category'] == input.getAttribute('data-cat')){
                    marks.splice(i, 1);
                    return
                }
            }
            return;
        }
        input.style.backgroundColor = 'lightblue';
        for (let i = 0; i < marks.length; i++) {
            if(marks[i]['student'] == input.getAttribute('data-student') && marks[i]['category'] == input.getAttribute('data-cat')){
                marks[i]['sign'] = input.value;
                return
            }
        }
        const mark = Object.create(null);
        mark['student'] = input.getAttribute('data-student');
        mark['category'] = input.getAttribute('data-cat');
        mark['mark'] = valid_marks[input.value];
        mark['operation'] = input.getAttribute('data-operation');
        marks.push(mark);
    }

    function save_marks(){
        if(marks.length==0){
            document.location.reload();
            return
        }
        document.getElementById('marks-json').value = JSON.stringify(marks);
        document.getElementById('marks-form').submit();
    }


</script>
@endsection
