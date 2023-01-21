@extends('layouts.headmaster')

@section('content')
<?php
    $teachers = DB::table('user_data')->where('group', 'T')->orderBy('user_data.last_name')->get();
//    $students = DB::table('user_data')->where('group', 'S')->get();
    $students = DB::table('user_data')->select('user_data.*', 'classes.name')->join('classes', 'classes.id', '=', 'user_data.class')->where('group', 'S')->orderBy('classes.name')->orderBy('user_data.last_name')->get();
?>
<div class="contener">
    <div class="name"> Panel zarządzania nauczycielami i uczniami </div>
    <div class="line"></div>
    <div class="window">
        <div>
            <h4>Nauczyciele</h4>
            <table>
                <tr>
                    <th class="table1" style="background-color: #2d3748; color: white">Imię</th>
                    <th class="table1" style="background-color: #2d3748; color: white">Nazwisko</th>
                    <th class="table1" style="background-color: #2d3748; color: white">Adres</th>
                    <th class="table1" style="background-color: #2d3748; color: white">Kod logowania</th>
                    <th class="table1" style="background-color: #2d3748; color: white">Opcje</th>
                </tr>
                @foreach($teachers as $teacher)
                    <tr>
                        <td class="table1">{{ $teacher->first_name }}</td>
                        <td class="table1">{{ $teacher->last_name }}</td>
                        <td class="table1">{{ $teacher->address }}</td>
                        <td class="table1">{{ $teacher->account_code }}</td>
                        <td class="EDbutton">
                            <a class="button3" href="#">Edytuj</a>
                            <a class="button3" href="#">Usuń</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <hr>
        <div>
            <h4>Uczniowie</h4>
            <table>
                <tr>
                    <th class="table1" style="background-color: #2d3748; color: white">Imię</th>
                    <th class="table1" style="background-color: #2d3748; color: white">Nazwisko</th>
                    <th class="table1" style="background-color: #2d3748; color: white">Adres</th>
                    <th class="table1" style="background-color: #2d3748; color: white">Klasa</th>
                    <th class="table1" style="background-color: #2d3748; color: white">Kod logowania</th>
                    <th class="table1" style="background-color: #2d3748; color: white">Kod rodzica</th>
                    <th class="table1" style="background-color: #2d3748; color: white">Opcje</th>
                </tr>
                @foreach($students as $student)
                    <tr>
                        <td class="table1">{{ $student->first_name }}</td>
                        <td class="table1">{{ $student->last_name }}</td>
                        <td class="table1">{{ $student->address }}</td>
                        <td class="table1">{{ $student->name }}</td>
                        <td class="table1">{{ $student->account_code }}</td>
                        <?php $parent = DB::table('user_data')->where('children', $student->id)->first(); ?>
                        <td class="table1">@if($parent){{ $parent->account_code }}@endif</td>
                        <td class="EDbutton">
                            <a class="button3" href="#">Edytuj</a>
                            <a class="button3" href="#">Usuń</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>

@endsection
