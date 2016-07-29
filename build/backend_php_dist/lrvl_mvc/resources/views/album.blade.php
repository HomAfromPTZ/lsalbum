@extends('layouts.app')

@section('content')
<ul>
	<li>Url: {{$url}}</li>
	<li>Username: {{$user['name']}}</li>
	<li>User avatar: {{$user['avatar']}}</li>
	<li>Album title: {{$album['title']}}</li>
	<li>Описание: {{$album['description']}}</li>
	<li>Обложка: {{$album->cover->img_url}}</li>
	<li>All Photos: {{$photos_num}}</li>
	<li>All Likes: {{$likes_num}}</li>
	<li>All Comments: {{$comments_num}}</li>
</ul>
	<h2>Фотографии:</h2>
	@forelse ($photos as $photo)
		<hr>
		<ul>
			<li>Photo thumb: <br/><img width="200" src="{{$photo['thumb_url']}}"/></li>
			<li>Photo img: {{$photo['img_url']}}</li>
			<li>Title: {{$photo['title']}}</li>
			<li>Description: {!!preg_replace("/(#(\w{3,}))/", "<a href='/search/?searchtext=$2&hashtag=true'>$1</a>", $photo->description)!!}</li>
			<li>Likes: {{$photo['likes']}}</li>
			<li>Comments: {{$photo['comments']}}</li>
		</ul>
	@empty
		{{-- empty expr --}}
	@endforelse
@endsection
