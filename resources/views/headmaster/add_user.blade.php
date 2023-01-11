@extends('layouts.headmaster')

@section('content')
<h3>
    Dodawanie nauczyciela
</h3>
<form method="post" action="{{ url('addUser') }}" >
    @csrf
    <label><input type="radio" name="group" value="S">Uczeń</label>
    <label hidden><input type="radio" name="group" value="P">Rodzic</label>
    <label><input type="radio" name="group" value="T">Nauczyciel</label>
    <label hidden><input type="radio" name="group" value="H">Dyrektor</label><br>
    Imie: <input type="text" name="first_name" /><br>
    Nazwisko: <input type="text" name="last_name"/><br>
    Adres: <input type="text" name="address"/><br>
    <br>
    <?php
        $classes = DB::table('classes')->get()
    ?>
    Klasa: <select name="class">
        @foreach($classes as $class)
            <option value="{{ $class->id }}">{{ $class->name }}</option>
        @endforeach
    </select>
    <input type="submit" value="Dodaj">
</form>
@endsection
