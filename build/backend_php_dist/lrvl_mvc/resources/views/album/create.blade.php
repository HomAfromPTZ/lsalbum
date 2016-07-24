@extends('layouts.app')
@section('content')
	<ul>
	@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
	@endforeach
	</ul>
	<form action="/album/save" method="post" enctype="multipart/form-data">
		{{csrf_field()}}
		<input type="text" name="title">
		<input type="file" name="cover">
		<input type="submit" value="Сохранить">
	</form>
@endsection