@extends('layouts.headmaster')

@section('content')
    <div class="contener">
        <div class="name"> Dodawanie Zajęć </div>
        <div class="line"></div>
        <div class="window">
                <form class="organizaton" method="post" action="{{ url('addLesson') }}" >
                    @csrf
                    <div class="descriptionr">
                        <div class="title" >Klasa:</div>
                        <div class="input">
                            <select name="class">
                                <?php $classes = DB::table('classes')->get(); ?>
                                @foreach($classes as $class)
                                    <option value="{{$class->id}}">{{$class->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="descriptionr">
                        <div class="title">Nazwa przedmiotu:</div>
                        <input class="input" type="text" name="name" /><br>
                    </div>
                    <div class="descriptionr">
                        <div class="title">Rok szkolny: </div>
                        <input class="input" type="text" name="school_year" value="2022/2023"/><br>
                    </div>
                    <div class="descriptionr">
                        <div class="title">Prowadzący:</div>
                        <?php $teachers = DB::table('user_data')->where('group', 'T')->get(); ?>
                        <select class="input" name="teacher">
                            <option value="NULL">Nieprzypisany</option>
                            @foreach($teachers as $teacher)
                                <option value="{{$teacher->id}}">{{$teacher->first_name}} {{$teacher->last_name}}</option>
                            @endforeach
                        </select><br>
                    </div>
                    <div class="descriptionr">
                        <input class="button" type="submit" value="Dodaj">
                    </div>

                </form>
        </div>
    </div>
@endsection
