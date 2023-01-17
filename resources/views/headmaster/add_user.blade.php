@extends('layouts.headmaster')

@section('content')
    <div class="contener">
        <div class="name"> Dodawanie Użytkownika </div>
        <div class="line"></div>
        <div class="window">
            <form class="organizaton" method="post" action="{{ url('addUser') }}" >
                @csrf
                <div class="descriptionr">
                    <label hidden="hidden"><input  class="check" type="radio" name="group" value="S">Uczeń</label>
                    <label hidden="hidden"><input class="check" type="radio" name="group" value="P">Rodzic</label>
                    <label hidden="hidden"><input class="check" type="radio" name="group" value="T">Nauczyciel</label>
                    <label hidden="hidden"><input class="check" type="radio" name="group" value="H">Dyrektor</label><br>

                </div>
                <div class="descriptionr">
                    <div class="title2">
                        Imie:
                    </div>
                    <div class="input">
                        <input type="text" name="first_name" /><br>
                    </div>
                </div>
                <div class="descriptionr">
                    <div class="title2">
                        Nazwisko:
                    </div>
                    <div class="input">
                        <input type="text" name="last_name"/><br>
                    </div>
                </div>
                <div class="descriptionr">
                    <div class="title2">
                        Adres:
                    </div>
                    <div class="input">
                        <input type="text" name="address"/><br>
                    </div>
                </div>
                <div class="descriptionr">
                    <?php
                    $classes = DB::table('classes')->get()
                    ?>
                    <div class="title2">
                        Klasa:
                    </div>
                    <div class="input">
                        <select name="class">
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="descriptionr">
                    <input class="button" type="submit" value="Dodaj">
                </div>
            </form>
        </div>
    </div>
@endsection
