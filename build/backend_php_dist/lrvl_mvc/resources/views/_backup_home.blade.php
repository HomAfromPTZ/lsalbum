@extends('layouts.app')

@section('content')



    <h2>Данные пользователя:</h2>
    =====================================
    <br/>Обновить данные залогиненного пользователя:
    <form action="/user/savedata" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <br/><input type="text" name="name" placeholder="Имя" value="{{$user['name']}}">
        <br/><input type="text" name="description" placeholder="Описание" value="{{$user['description']}}">
        <br/><input type="text" name="vk" placeholder="vkontakte" value="{{$user['vk']}}">
        <br/><input type="text" name="facebook" placeholder="facebook" value="{{$user['facebook']}}">
        <br/><input type="text" name="twitter" placeholder="twitter" value="{{$user['twitter']}}">
        <br/><input type="text" name="google" placeholder="google+" value="{{$user['google']}}">
        <br/><input type="text" name="instagram" placeholder="instagram" value="{{$user['instagram']}}">
        <br/>Аватар: <input type="file" name="avatar">
        <br/>Фон: <input type="file" name="background">
        <br/><input type="submit" value="Сохранить">
    </form>
    <hr/>
    <h3>Текущие данные:</h3>
    <ul>
        <li><a href="/user/{{$user['id']}}">Ссылка на профиль</a></li>
        <li>Имя: {{$user['name']}}</li>
        <li>Описание: {{$user['description']}}</li>
        <li>Email: {{$user['email']}}</li>
        <li>Vk: {{$user['vk']}}</li>
        <li>Facebook: {{$user['facebook']}}</li>
        <li>Twitter: {{$user['twitter']}}</li>
        <li>Google: {{$user['google']}}</li>
        <li>Instagram: {{$user['instagram']}}</li>
        <li>Avatar: {{$user['avatar']}}</li>
        <li>Background: {{$user['background']}}</li>
    </ul>
    <hr/>
    <h2>Альбомы и фотографии</h2>
    <a href="{{url('album/create')}}">Создать\Обновить\Удалить альбом &gt;&gt;</a> <br/>
    <a href="{{url('photo/create')}}">Создать\Обновить\Удалить фотографию &gt;&gt;</a><br/><br/>

    @if(count($photos) == 0)
        Нет фото =(
    @else

        <h3>Мои альбомы:</h3>
        @forelse ($albums as $album)
            <div>
            =======================================
            <ul>
                <li><a href="/album/{{$album['id']}}">Ссылка на альбом</a></li>
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

        <h3>Последние фотографии пользователей:</h3>
        @forelse ($photos as $photo)
            <div>
            =======================================
            <ul>
                <li>Фото id: {{$photo['id']}}</li>
                <li>Title: {{$photo['title']}}</li>
                <li>Description:
                {!!preg_replace("/(#(\w{3,}))/", "<a href='/search/?searchtext=$2&hashtag=true'>$1</a>", $photo->description)!!}
                </li>
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