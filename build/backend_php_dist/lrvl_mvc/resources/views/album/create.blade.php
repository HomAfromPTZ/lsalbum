@extends('layouts.app')
@section('content')
	<ul>
	@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
	@endforeach
	</ul>
<br>Create new album
	<form action="/album/save" method="post" enctype="multipart/form-data">
		{{csrf_field()}}
		<input type="text" name="title" placeholder="Название">
		<input type="text" name="description" placeholder="Описание">
		<input type="file" name="cover">
		<input type="submit" value="Сохранить">
	</form>
<br><br>Update latest created album (id = {{$latest_album['id'] or "Не существует"}})
	<form action="/album/update/{{$latest_album['id'] or ""}}" method="post" enctype="multipart/form-data">
		{{csrf_field()}}
		<input type="text" name="title" placeholder="Название" value="{{$latest_album['title'] or ""}}">
		<input type="text" name="description" placeholder="Описание" value="{{$latest_album['description'] or ""}}">
		<input type="file" name="cover">
		<input type="submit" value="Сохранить">
	</form>

<br><br>
	@if ($latest_album['id'])
		<a href="/album/delete/{{$latest_album['id']}}">
			Delete latest album (id = {{$latest_album['id']}}) &gt;&gt;
		</a>
	@endif
@endsection