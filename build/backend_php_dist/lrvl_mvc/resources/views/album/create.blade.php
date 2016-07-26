@extends('layouts.app')
@section('content')
	<ul>
	@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
	@endforeach
	</ul>
<br>Create
	<form action="/album/save" method="post" enctype="multipart/form-data">
		{{csrf_field()}}
		<input type="text" name="title" placeholder="Название">
		<input type="text" name="description" placeholder="Описание">
		<input type="file" name="cover">
		<input type="submit" value="Сохранить">
	</form>
<br><br>Update
	<form action="/album/update/29" method="post" enctype="multipart/form-data">
		{{csrf_field()}}
		<input type="text" name="title" placeholder="Название">
		<input type="text" name="description" placeholder="Описание">
		<input type="file" name="cover">
		<input type="submit" value="Сохранить">
	</form>
@endsection