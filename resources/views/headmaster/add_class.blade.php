@extends('layouts.headmaster')

@section('content')
    <div class="contener">
        <div class="name"> Dodawanie Klasy </div>
        <div class="line"></div>
        <div class="window">
            <form method="post" action="{{ url('addClass') }}" >
                @csrf
                <div class="organizaton">
                    <div class="descriptionc">Nazwa oddziału:
                        <input type="text" name="name" /><br>
                    </div>
                    <div class="descriptionc">Rok szkolny:
                        <input type="text" name="school_year" value="2022/2023"/><br>
                        <input class="button" type="submit" value="Dodaj">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
