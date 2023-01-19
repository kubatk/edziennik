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
<h3>Wiadomości</h3>
<button onclick="window.location.replace('{{route('new_message')}}')">Nowa wiadomość</button>
<button onclick=document.location.reload(true)>Odśwież</button>

<br>
Odebrane wiadomości:
<style>th,td{border:solid 1px black;}
    .unread-message{
        font-weight: bold;
    }
    .opened-message{
        background-color: #aaa;
    }
</style>
<table>
    <tr>
        <th>Nadawca</th>
        <th>Temat</th>
        <th>Data</th>
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
    @foreach($messages as $message)
        <tr class="@if(isset($read_message) && $message->id == $read_message->id) opened-message @endif @if(!$message->read) unread-message @endif"
            onclick="read_message({{$message->id}})">
            <td>{{$message->first_name}} {{$message->last_name}}</td>
            <td>{{$message->title}}</td>
            <td>{{$message->created_at}}</td>
        </tr>
    @endforeach
</table>

<div id="messages-list">

</div>
<hr>
<div id="message-preview">
    @if(isset($read_message))
        <button onclick="window.location.replace('{{route('new_message', ['reply'=>$read_message->id])}}')">Odpowiedz</button>
        <button>Usuń</button>
        <p><b>Nadawca:</b> {{$read_message->first_name}} {{$read_message->last_name}}</p>
        <p><b>Temat:</b> {{$read_message->title}}</p>
        <p>
            <b>Treść:</b><br>
            <pre>{{$read_message->content}}</pre>
        </p>

    @endif

</div>


<script>
    function read_message(id){
        window.location.replace("{{route('read_message', ['id'=>'%id%'])}}".replace('%id%', id))
    }
</script>
@endsection
