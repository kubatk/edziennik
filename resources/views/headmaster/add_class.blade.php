@extends('layouts.headmaster')

@section('content')
<h3>
    Dodawanie Klasy
</h3>
<form method="post" action="{{ url('addClass') }}" >
    @csrf
    Nazwa oddziału: <input type="text" name="name" /><br>
    Rok szkolny: <input type="text" name="school_year" value="2022/2023"/><br>
    <input type="submit" value="Dodaj">
</form>
@endsection
