@extends('layouts.headmaster')

@section('content')
    <div class="contener">
        <div class="name"> Dodawanie Użytkownika </div>
        <div class="line"></div>
        <div class="window">
            <form class="organizaton" method="post" action="{{ url('addUser') }}" >
                @csrf
                <div class="descriptionr">
                    <label ><input  class="check" type="radio" name="group" value="S" onchange="switch_student_teacher()">Uczeń</label>
                    <label hidden="hidden"><input class="check" type="radio" name="group" value="P">Rodzic</label>
                    <label ><input class="check" type="radio" name="group" value="T" checked onchange="switch_student_teacher()">Nauczyciel</label>
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
                    <div class="title2 form-class">
                        Klasa:
                    </div>
                    <div class="input form-class">
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


    <script>
        var add_mode = 'student'
        function switch_student_teacher(){
            if(add_mode=='student'){
                document.querySelectorAll('.form-class').forEach(e => {
                    e.style.display = 'none'
                })
                add_mode='teacher'
            }
            else if(add_mode=='teacher'){
                document.querySelectorAll('.form-class').forEach(e => {
                    e.style.display = 'block'
                })
                add_mode='student'
            }
        }
        switch_student_teacher()
    </script>
@endsection
