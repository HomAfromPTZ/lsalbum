@extends('layouts.app')

@section('title', 'Альбом - '.$album->title )

@section('head')
@include('_common.head')
@endsection

@section('content')
<body class="album-page">
	@include('_common.sprites')
	@include('_common.preloader')
	@include('_common.popup')
	@include('_common.edit-album-header')
	@include('_common.add-photos-modal')
	@include('_common.edit-photo-modal')
	@include('_common.slider')
	@include('_templates.comment-item-template')
	@include('_templates.photo-item-template')

	<div class="page">
		<header class="header header_album" style="background-image: url('{{ $album->cover->img_url }}')">
			<div class="header-holder">
				<div class="fix-width">
					<div class="user-info-holder">
						<div class="user-avatar">
							<div class="user-avatar__img">
								<img src="{{ ($user->avatar !== '') ? $user->avatar : '/assets/img/default_avatar.jpg' }}"/>
							</div>
						</div>
						<div class="user-info">
							<h3 class="user-info__name">{{ $user->name }}</h3>
						</div>
					</div>
					<div class="header-content">
						<h1 class="my-album-title">{{ $album->title }}</h1>
						<div class="my-album-desc">{!!preg_replace("/(#(\w{3,}))/", "<a href='/search/?searchtext=$2&hashtag=true'>$1</a>", $album->description)!!}</div>
					</div>
					<div class="header-buttons">
						<div class="header-buttons__item">
							<a href="/" class="btn btn_animated preload-link"><i class="fa fa-home"></i>
								<span>На главную</span>
							</a>
						</div>
						<div class="header-buttons__item">
							@if(Auth::user()->id == $user->id)
							<button class="btn btn_animated js-edit-album-header"><i class="fa fa-pencil"></i><span>Редактировать</span></button>
							@endif
						</div>
					</div>
				</div>
			</div>
		</header>
		<div class="gray-bg">
			<ul class="album-general-info">
				<li>Фотографий:<span class="photo-count">{{ $album->photos->count() }}</span></li>
				<li>Лайков:<span class="like-count">{{ $likes_num }}</span></li>
				<li>Комментариев:<span class="comments-count">{{ $comments_num }}</span></li>
			</ul>
		</div>
		<div class="content">
			<div class="fix-width">
				<div class="new-photos-album">
					<div class="add-album-btn js-add-photos">
						<button class="btn btn_animated"><i class="fa fa-plus"></i><span>Добавить</span></button>
					</div>
					<div class="album-container">
						
						@include('_common.photos-list')
					
					</div>
				</div>
			</div>
		</div>

		@include('_common.footer')
	</div>

{{-- Javascripts --}}

@include('_common._js')

</body>
@endsection
