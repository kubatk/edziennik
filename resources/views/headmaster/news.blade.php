@extends('layouts.headmaster')

@section('content')
<p>Kolejny moduł do stylowania (╯°□°）╯︵ ┻━┻</p>

<h3>Aktualnie wyświetlane wpisy:</h3>
<?php $news = DB::table('news')
    ->select('news.*', 'user_data.first_name', 'user_data.last_name')
    ->join('user_data', 'added_by', '=', 'user_data.id')
    ->orderBy('news.id', 'DESC')
    ->get(); ?>
<ul>
    @foreach($news as $n)
            <li>
                {{$n->content}}<br>
                Dodane przez: {{$n->first_name}} {{$n->last_name}} | {{$n->created_at}} | <a href="#" onclick="delete_news({{$n->id}})">Usuń</a>
                <br><br>
            </li>
    @endforeach
</ul>


<h3>Dodaj nowy wpis:</h3>
<form method="post" action="{{url('addNews')}}">
    @csrf
    <textarea cols="40" rows="5" name="content"></textarea><br>
    <input type="submit" value="Dodaj">
</form>


<form method="post" action="{{url('removeNews')}}" id="delete-news-form" style="display: none;">
    @csrf
    <input type="hidden" name="id" id="delete-news-id">
</form>
<script>
    function delete_news(id){
        var confirmed = confirm("Czy na pewno chcesz usunąć wpis?")

        if(confirmed){
            document.getElementById('delete-news-id').value = id;
            document.getElementById('delete-news-form').submit();
        }
    }
</script>
@endsection
