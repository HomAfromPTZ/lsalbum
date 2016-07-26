@extends('layouts.app')

@section('content')
    <a href="{{url('album/create')}}">Создать\Обновить\Удалить альбом &gt;&gt;</a> <br/>
    <a href="{{url('photo/create')}}">Создать\Обновить\Удалить фотографию &gt;&gt;</a><br/><br/>

    @if(count($photos) == 0)
        Нет фото =(
    @endif
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
                <img width="100" src="{{$album->photos->find($album['cover_id'])->img_url}}"/>
                </li>
            </ul>
            =======================================
            </div>
        @empty
            {{-- empty expr --}}
        @endforelse

        <h2>Мои Фото:</h2>
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
            =======================================
            </div>
        @empty
            {{-- empty expr --}}
        @endforelse
@endsection
