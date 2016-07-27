@extends('layouts.app')

@section('content')
    <ul>
        <li>Имя: {{$user['name']}}</li>
        <li>Описание: {{$user['description']}}</li>
        <li>Email: {{$user['email']}}</li>
        <li>Vk: {{$user['vk']}}</li>
        <li>Facebook: {{$user['facebook']}}</li>
        <li>Twitter: {{$user['twitter']}}</li>
        <li>Google: {{$user['google']}}</li>
        <li>Instagram: {{$user['instagram']}}</li>
        <li>Avatar:<br/><img width="100" src="{{$user['avatar']}}"/></li>
        <li>Background:<br/><img width="100" src="{{$user['background']}}"/></li>
    </ul>
    <h2>Альбомы</h2>
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

@endsection