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
        <div class="name"> Wiadomości </div>
        <div class="line"></div>
        <div class="window">
            <img class="icon" src="{{ asset('assets/plus-square.svg') }}" title="NOWA WIADOMOŚĆ" alt="nowa wiadomość" onclick="window.location.replace('{{route('new_message')}}')">
            <img class="icon" src="{{ asset('assets/repeat.svg') }}" title="ODŚWIEŻ" alt="odśwież wiadomość" onclick=document.location.reload(true)>
            <br>
            <div style="display: flex">
                <div class="communicator_left">
                    <h3>Odebrane wiadomości:</h3>
                    <table style="width: 100%;">
                        <tr>
                            <th  style="padding: 20px">Nadawca</th>
                            <th  style="padding: 20px">Temat</th>
                            <th  style="padding: 20px">Data</th>
                        </tr>
                        <?php
                        $messages = DB::table('messages')
                            ->select('messages.*', 'user_data.first_name', 'user_data.last_name', 'receivers.read')
                            ->join('receivers', 'messages.id', '=', 'receivers.message')
                            ->join('user_data', 'messages.sender', '=', 'user_data.id')
                            ->where('receivers.user', auth()->user()->id)
                            ->orderBy('created_at', 'DESC')
                            ->get()
                        ?>
                        @if(count($messages)==0)
                            <tr>
                                <td colspan="3">Nie masz żadnych wiadomości w skrzynce.</td>
                            </tr>
                        @endif
                        <div>
                            @foreach($messages as $message)
                                <tr  class="communicator_left_insade @if(isset($read_message) && $message->id == $read_message->id) opened-message @endif @if(!$message->read) unread-message @endif message"
                                     onclick="read_message({{$message->id}})">
                                    <td>{{$message->first_name}} {{$message->last_name}}</td>
                                    <td>{{$message->title}}</td>
                                    <td>{{$message->created_at}}</td>
                                </tr>
                            @endforeach
                        </div>
                    </table>
                </div>
                <div class="communicator_right"  id="message-preview">
                    @if(isset($read_message))
                        <img class="icon" src="{{ asset('assets/reply.svg') }}" title="ODPOWIEDZ" alt="Odpowiedz" onclick="window.location.replace('{{route('new_message', ['reply'=>$read_message->id])}}')">
                        <img class="icon" src="{{ asset('assets/envelope-dash.svg') }}" title="USUŃ WIADOMOŚĆ" alt="Usuń wiadomość" >
                        <p><b>Nadawca:</b> {{$read_message->first_name}} {{$read_message->last_name}}</p>
                        <p><b>Temat:</b> {{$read_message->title}}</p>
                        <p>
                            <b>Treść:</b>
                        <pre class="communicator_right_insade">{{$read_message->content}}</pre>
                        </p>

                    @endif
                </div>
            </div>
        </div>
    </div>

{{--    <div id="messages-list">--}}

{{--    </div>--}}



<script>
    function read_message(id){
        window.location.replace("{{route('read_message', ['id'=>'%id%'])}}".replace('%id%', id))
    }
</script>
@endsection
