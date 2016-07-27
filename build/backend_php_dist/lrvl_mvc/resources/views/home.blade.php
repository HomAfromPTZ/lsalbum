@extends('layouts.app')

@section('content')
    <a href="{{url('album/create')}}">Создать\Обновить\Удалить альбом &gt;&gt;</a> <br/>
    <a href="{{url('photo/create')}}">Создать\Обновить\Удалить фотографию &gt;&gt;</a><br/><br/>

    @if(count($photos) == 0)
        Нет фото =(
    @else

        <h2>Мои альбомы:</h2>
        @forelse ($albums as $album)
            <div>
            =======================================
            <ul>
                <li>Id: {{$album['id']}}</li>
                <li>Title: {{$album['title']}}</li>
                <li>Description: {{$album['description']}}</li>
                <li>Cover_id: {{$album['cover_id']}}</li>
                <li>User_id: {{$album['user_id']}}</li>
                <li>Cover:<br/>
                <img width="100" src="{{$album->cover->img_url}}"/>
                </li>
            </ul>
            =======================================
            </div>
        @empty
            {{-- empty expr --}}
        @endforelse

        <h2>Фотографии:</h2>
        @forelse ($photos as $photo)
            <div>
            =======================================
            <ul>
                <li>Фото id: {{$photo['id']}}</li>
                <li>Title: {{$photo['title']}}</li>
                <li>Description: {{$photo['description']}}</li>
                <li>Img:<br/>
                <img width="100" src="{{$photo['img_url']}}"/></li>
                <li>Thumb:<br/>
                <img width="100" src="{{$photo['thumb_url']}}"/></li>
                <li>Album: {{$photo['album_id']}}</li>
            </ul>
            <div>
                Комментарий и лайк:
                <br/><br/>
                <button class="like-button" data-liked="{{$photo->like->where('user_id', $auth_id)->count()}}" data-photoid="{{$photo['id']}}">Поставить лайк: <span>{{($photo->like->count())}}</span></button>
                <br/><br/>
                <form action="/comment/{{$photo['id']}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="text" name="content" placeholder="Текст комментария">
                    <input type="submit" value="Сохранить">
                </form>
                <ul>
                @forelse ($photo->comment as $comment)
                    <li>{{$comment->content}}</li>
                @empty
                    <li>Комментариев нет</li>
                @endforelse
                </ul>
            </div>
            =======================================
            </div>
        @empty
            {{-- empty expr --}}
        @endforelse
    @endif

<script   src="https://code.jquery.com/jquery-2.2.4.min.js"   integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="   crossorigin="anonymous"></script>
<script type="text/javascript">
    $(".like-button").click(function(e){
        var like_button = $(this),
            photo_id = like_button.data("photoid"),
            is_liked = like_button.data("liked"),
            likes_num = parseInt(like_button.find('span').html());

        if(!is_liked){
            $.ajax({
                url: "/like/" + photo_id,
                type: "GET",
                dataType: "json"
            }).done(function(resp){
                like_button.find('span').html(++likes_num);
                like_button.data('liked', 1);
            }).fail(function(resp){
                alert("Ошибка сервера");
            });
        } else {
            $.ajax({
                url: "/unlike/" + photo_id,
                type: "GET",
                dataType: "json"
            }).done(function(resp){
                like_button.find('span').html(--likes_num);
                like_button.data('liked', 0);
            }).fail(function(resp){
                alert("Ошибка сервера");
            });
        }
    });
</script>

@endsection