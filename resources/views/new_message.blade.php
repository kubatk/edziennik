<?php if(!isset($usergroup)) return redirect()->route('home');
$view="";
switch($usergroup){
    case 'H': $view='layouts.headmaster'; break;
    case 'T': $view='layouts.teacher'; break;
    case 'S': $view='layouts.student'; break;
    case 'P': $view='layouts.parent'; break;
}
?>
@extends($view)

@section('content')
    <div class="contener">
        <div class="name"> Nowa wiadomość </div>
        <div class="line"></div>
        <div class="window">
            <form action="{{route('addNewMessage')}}" method="post">
                @csrf
                <button type="button" onclick="show_receiver_box()" style="background: none;border: none;padding: 0;">
                    <img class="icon" src="{{ asset('assets/person.svg') }}" alt="Wybierz" title="WYBIERZ ODBIORCÓW">
                </button>

                <input style="width: 90%" type="text" id="receivers-display" disabled>
                <input type="hidden" name="receivers-id" id="receivers-id">
                <br>


                <div style="display: flex">
                    <div style="margin: 5px 12px" >Temat</div><input style="width: 90%" type="text" name="title" @if(isset($reply)) value="RE: {{$reply->title}}" @endif>
                </div>
                <br>
                <div style="display: flex">
                    <div style="margin: 5px 15px" >Treść</div>
                    <textarea style="width: 90%;" cols="150" rows="10" name="content">@if(isset($reply))&#13;&#10;--- {{$reply->first_name}} {{$reply->last_name}} w dniu {{$reply->created_at}} napisał/a: ---
                        {{$reply->content}}@endif</textarea>
                </div>
                <br>
                <button type="submit" style="margin-left: 50px; background: none;border: none;padding: 0;">
                    <img class="icon" src="{{ asset('assets/send.svg') }}"  type="submit" title="WYŚLIJ" alt="Wyślij">
                </button>

                <button type="reset" onclick="window.location.replace('{{route('messages')}}')" style="background: none;border: none;padding: 0;">
                    <img class="icon" src="{{ asset('assets/minus.svg') }}"  type="submit" alt="Anuluj" title="ANULUJ">
                </button>
            </form>


            <hr>
        </div>
    </div>





        <style>

        </style>




        <div class="form-popup" id="choose-reveivers-form">
            Zaznacz adresatów
            <details>
                <summary>Dyrekcja</summary>
                <div class="indent">
                    <?php $users = DB::table('user_data')->where('group', 'H')->where('id', '!=', auth()->user()->user)->get(); ?>
                    @foreach($users as $user)
                        <label><input type="checkbox" value="{{$user->id}}" data-first-name="{{$user->first_name}}" data-last-name="{{$user->last_name}}" @if(isset($reply) && $reply->sender==$user->id) checked @endif> {{$user->first_name}} {{$user->last_name}}</label><br>
                    @endforeach
                </div>
            </details>
            <details>
                <summary>Nauczyciele</summary>
                <div class="indent">
                    <?php $users = DB::table('user_data')->where('group', 'T')->where('id', '!=', auth()->user()->user)->get(); ?>
                    @foreach($users as $user)
                        <label><input type="checkbox" value="{{$user->id}}" data-first-name="{{$user->first_name}}" data-last-name="{{$user->last_name}}" @if(isset($reply) && $reply->sender==$user->id) checked @endif> {{$user->first_name}} {{$user->last_name}}</label><br>
                    @endforeach
                </div>
            </details>
            <details>
                <summary>Klasy</summary>
                <div class="indent">
                    <?php $classes = DB::table('classes')->get(); ?>
                    @foreach($classes as $class)
                        <details>
                            <summary>{{$class->name}}</summary>
                            <div class="indent">
                                <details>
                                    <summary>Uczniowie</summary>
                                    <div class="indent">
                                            <?php $users = DB::table('user_data')->where('group', 'S')->where('id', '!=', auth()->user()->user)->where('class', $class->id)->get(); ?>
                                        @foreach($users as $user)
                                            <label><input type="checkbox" value="{{$user->id}}" data-first-name="{{$user->first_name}}" data-last-name="{{$user->last_name}}" @if(isset($reply) && $reply->sender==$user->id) checked @endif> {{$user->first_name}} {{$user->last_name}}</label><br>
                                        @endforeach
                                    </div>
                                </details>
                                <details>
                                    <summary>Rodzice</summary>
                                    <div class="indent">
                                    </div>
                                </details>
                            </div>
                        </details>
                    @endforeach
                </div>
            </details>
            <button class="button" onclick="hide_receiver_box()">Zapisz</button>
        </div>



<script>
    function show_receiver_box(){
        document.getElementById('choose-reveivers-form').style.display = 'block';
    }
    function hide_receiver_box(){
        document.getElementById('choose-reveivers-form').style.display = 'none';
        save_receivers()
    }
    var receivers_id = ""
    var receivers_string = ""
    function save_receivers(){
        var all_reveivers = document.querySelectorAll('div#choose-reveivers-form input[type="checkbox"]');
        receivers_id = []
        receivers_string = ""

        all_reveivers.forEach(element => {
            if(element.checked){
                console.log(element.value+" "+element.getAttribute('data-first-name')+" "+element.getAttribute('data-last-name'))
                receivers_id.push(element.value)
                receivers_string+=element.getAttribute('data-first-name')+" "+element.getAttribute('data-last-name')+"; "
            }
        })

        receivers_id = receivers_id.toString()
        document.getElementById('receivers-display').value = receivers_string
        document.getElementById('receivers-id').value = receivers_id
    }

    save_receivers();
</script>
@endsection
