@extends('layouts.app')
@section('content')
	<ul>
	@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
	@endforeach
	</ul>
<br>Create new photo in latest album (album_id = {{$latest_album['id'] or "Не существует"}})
	<form action="/photo/save/{{$latest_album['id']}}" method="post" enctype="multipart/form-data">
		{{csrf_field()}}
		<input type="text" name="title" placeholder="Название">
		<input type="text" name="description" placeholder="Описание">
		<input type="file" name="cover">
		<input type="submit" value="Сохранить">
	</form>
<br><br>Update latest created photo (id = {{$latest_photo['id'] or "Не существует"}})
	<form action="/photo/update/{{$latest_photo['id'] or ""}}" method="post" enctype="multipart/form-data">
		{{csrf_field()}}
		<input type="text" name="title" placeholder="Название" value="{{$latest_photo['title'] or ""}}">
		<input type="text" name="description" placeholder="Описание" value="{{$latest_photo['description'] or ""}}">
		<input type="submit" value="Сохранить">
	</form>

<br><br>
@if ($latest_photo['id'])
		<a href="/photo/delete/{{$latest_photo['id']}}">
			Delete latest photo (id = {{$latest_photo['id']}}) &gt;&gt;
		</a>
	@endif
@endsection