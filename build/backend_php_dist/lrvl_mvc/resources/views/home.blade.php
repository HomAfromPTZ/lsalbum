@extends('layouts.app')

@section('content')
    @if(count($photos) == 0)
        Нет фото =(
    @endif
        Мои альбомы:
        @forelse ($albums as $album)
            <div>
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
            </div>
        @empty
            {{-- empty expr --}}
        @endforelse

        Мои Фото:
        @forelse ($photos as $photo)
            <div>
            <ul>
                <li>Id: {{$photo['id']}}</li>
                <li>Title: {{$photo['title']}}</li>
                <li>Description: {{$photo['description']}}</li>
                <li>Img:<br/>
                <img width="100" src="{{$photo['img_url']}}"/></li>
                <li>Thumb:<br/>
                <img width="100" src="{{$photo['thumb_url']}}"/></li>
                <li>Album: {{$photo['album_id']}}</li>
            </ul>
            </div>
        @empty
            {{-- empty expr --}}
        @endforelse
@endsection
