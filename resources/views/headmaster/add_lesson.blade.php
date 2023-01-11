@extends('layouts.headmaster')

@section('content')
<h3>
    Dodawanie zajęć
</h3>
<form method="post" action="{{ url('addLesson') }}" >
    @csrf
    Klasa:
    <select name="class">
        <?php $classes = DB::table('classes')->get(); ?>
        @foreach($classes as $class)
            <option value="{{$class->id}}">{{$class->name}}</option>
        @endforeach
    </select><br>
    Nazwa przedmiotu: <input type="text" name="name" /><br>
    Rok szkolny: <input type="text" name="school_year" value="2022/2023"/><br>
    Prowadzący:
    <?php $teachers = DB::table('user_data')->where('group', 'T')->get(); ?>
    <select name="teacher">
        <option value="NULL">Nieprzypisany</option>
        @foreach($teachers as $teacher)
            <option value="{{$teacher->id}}">{{$teacher->first_name}} {{$teacher->last_name}}</option>
        @endforeach
    </select><br>
    <input type="submit" value="Dodaj">
</form>
@endsection
