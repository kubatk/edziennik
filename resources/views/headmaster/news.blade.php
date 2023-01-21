@extends('layouts.headmaster')

@section('content')
    <div class="contener">
        <div class="name"> DODAWANIE OGŁOSZEŃ </div>
        <div class="line"></div>
        <div class="window">
            <div class="news_list">
                <div>
                    <h3>Aktualnie wyświetlane wpisy:</h3>
                    <div class="news_page" style="background-color: #9dabb9; border-radius: 20px; padding: 30px 50px">
                        <?php $news = DB::table('news')
                            ->select('news.*', 'user_data.first_name', 'user_data.last_name')
                            ->join('user_data', 'added_by', '=', 'user_data.id')
                            ->orderBy('news.id', 'DESC')
                            ->get(); ?>
                        <ul>
                            @foreach($news as $n)
                                <p >
                                <div class="single_new" >
                                    {{$n->content}}
                                    <div class="descryption_news">
                                        <a style="background: none;border: none"  href="#" onclick="delete_news({{$n->id}})">
                                            <img class="icon" src="{{ asset('assets/trash3.svg') }}"  type="submit" alt="usuń" title="USUŃ WPIS">
                                        </a>
                                        Dodane przez: {{$n->first_name}} {{$n->last_name}} dnia: {{$n->created_at}}
                                    </div>

                                </div>

                                </p>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div style="margin: 30px">
                    <h2>Dodaj nowy wpis:</h2>
                    <form method="post" action="{{url('addNews')}}">
                        @csrf
                        <textarea cols="70" rows="15" name="content"></textarea><br>
                        <input class="button2" type="submit" value="Dodaj">
                    </form>


                    <form method="post" action="{{url('removeNews')}}" id="delete-news-form" style="display: none;">
                        @csrf
                        <input type="hidden" name="id" id="delete-news-id">
                    </form>

                </div>
            </div>

        </div>
    </div>

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
