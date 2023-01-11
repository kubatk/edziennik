@extends('layouts.headmaster')

@section('content')
<?php
//    $classes = DB::table('classes')->select(DB::raw("SELECT classes.name, classes.id, COUNT(user_data.id) as count"))->join('user_data', 'classes.id', '=', 'user_data.class')->groupBy('classes.id');
    $classes = DB::select(DB::raw('SELECT classes.name, classes.id, COUNT(user_data.id) as count FROM classes JOIN user_data ON classes.id = user_data.class GROUP BY classes.id, classes.name'));
?>
<h3>
    Zarządzanie oddziałami
</h3>
<table>
    <tr>
        <th>Oddział</th>
        <th>Uczniowie</th>
        <th>Opcje</th>
    </tr>
    @foreach($classes as $class)
        <tr>
            <td>{{$class->name}}</td>
            <td>{{ $class->count }}</td>
            <td>
                <a href="#">Edytuj</a>
                <a href="#">Pokaż listę uczniów</a>
                <a href="{{ route('headmaster_timetable', $class->id) }}">Pokaż plan zajęć</a>
            </td>
        </tr>
    @endforeach
</table>

@endsection
