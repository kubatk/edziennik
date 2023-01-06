@extends('layouts.headmaster')

@section('content')
<?php
    $teachers = DB::table('user_data')->where('group', 'T')->get();
    $students = DB::table('user_data')->where('group', 'S')->get();
?>
<h3>
    Panel zarządzania nauczycielami i uczniami
</h3>
<div>
    <h4>Nauczyciele</h4>
    <table>
        <tr>
            <th>Imię</th>
            <th>Nazwisko</th>
            <th>Adres</th>
            <th>Kod logowania</th>
            <th>Opcje</th>
        </tr>
        @foreach($teachers as $teacher)
            <tr>
                <td>{{ $teacher->first_name }}</td>
                <td>{{ $teacher->last_name }}</td>
                <td>{{ $teacher->address }}</td>
                <td>{{ $teacher->account_code }}</td>
                <td>
                    <a href="#">Edytuj</a>
                    <a href="#">Usuń</a>
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
            <th>Imię</th>
            <th>Nazwisko</th>
            <th>Adres</th>
            <th>Kod logowania</th>
            <th>Opcje</th>
        </tr>
        @foreach($students as $student)
            <tr>
                <td>{{ $student->first_name }}</td>
                <td>{{ $student->last_name }}</td>
                <td>{{ $student->address }}</td>
                <td>{{ $student->account_code }}</td>
                <td>
                    <a href="#">Edytuj</a>
                    <a href="#">Usuń</a>
                </td>
            </tr>
        @endforeach
    </table>
</div>
@endsection
