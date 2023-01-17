@extends('layouts.headmaster')

@section('content')
<?php
//    $classes = DB::table('classes')->select(DB::raw("SELECT classes.name, classes.id, COUNT(user_data.id) as count"))->join('user_data', 'classes.id', '=', 'user_data.class')->groupBy('classes.id');
    $classes = DB::select(DB::raw('SELECT classes.name, classes.id, COUNT(user_data.id) as count FROM classes JOIN user_data ON classes.id = user_data.class GROUP BY classes.id, classes.name'));
?>
<div class="contener">
    <div class="name"> Zarządzanie Oddziałami </div>
    <div class="line"></div>
    <div class="window">
        <table>
            <tr>
                <td class="tableA">Oddział</td>
                <td class="tableB">Uczniowie</td>
                <td class="tableC">Opcje</td>
            </tr>
            @foreach($classes as $class)
                <tr>
                    <td class="tableA" >{{$class->name}}</td>
                    <td class="tableB" >{{ $class->count }}</td>
                    <td class="tableC descriptionr" >
                        <div class="button2" href="#">Edytuj </div>
                        <div class="button2" href="#">Pokaż listę uczniów </div>
                        <a class="button2" href="{{ route('headmaster_timetable', $class->id) }}">Pokaż plan zajęć </a>

                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>

@endsection
