@extends('layouts.app')

@section('title', 'Главная - '.$user['name'] )

@section('head')
@include('_common.head')
@endsection

@section('content')
<body class="main-page">
	@include('_common.sprites')
	@include('_common.preloader')
	@include('_common.popup')
	@include('_common.add-albums-modal')
	@include('_common.edit-album-modal')
	@include('_common.edit-user-header')
	@include('_common.slider')


	<div class="page">

		<header class="header header_main" style="background-image: url({{ ($user->background !== '') ? $user->background : 'assets/img/bg/main-header.jpg' }});">
			<div class="header-holder">
				<div class="fix-width">
					<div class="user-info-holder">

						<div class="user-avatar">
							<div class="user-avatar__img">
								<img id="user-avatar" src="{{ ($user->avatar !== '') ? $user->avatar : 'assets/img/default_avatar.jpg' }}"/>
							</div>
						</div>

						<div class="user-info">
							<h3 class="user-info__name">{{$user['name']}}</h3>
							<div class="user-info__desc">{{$user['description']}}</div>

							@include('_common.show-socials')

						</div>
					</div>
					<div class="header-buttons">
						<div class="header-buttons__item">
							<button class="btn btn_animated js-edit-user-header">
								<i class="fa fa-pencil"></i>
								<span>Редактировать</span>
							</button>
						</div>
						<div class="header-buttons__item">
							<a href="{{ url('/logout') }}" class="btn btn_animated btn__logut">
								<i class="fa fa-power-off"></i>
								<span>Выйти</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</header>

		<div class="search-holder">
			<div class="fix-width">
				<form class="search-form" action="/search/">
					<div class="search-form-holder">
						<button type="submit" class="search-form__btn fa fa-search"></button>
						<input name="searchtext" type="text" placeholder="Исследовать мир" class="search-form__input">
					</div>
				</form>
			</div>
		</div>
		<div class="content">
			<div class="fix-width">
				<div class="new-photos-album">
					<h2 class="album-title">Новое в мире</h2>
					<div class="album-container">
						@include('_common.photos-list')
				</div>

				@if($photos_count > 6)
				<div class="show-more">
					<button class="btn btn_transparent">Показать еще</button>
				</div>
				@endif

			</div>
		</div>

		<div class="my-photos">
			<div class="fix-width">

				<div class="title-holder">
					<h2 class="album-title">Мои альбомы</h2>
					<div class="add-album-btn">
						<button class="btn btn_animated js-add-album"><i class="fa fa-plus"></i><span>Добавить</span></button>
					</div>
				</div>

				@include('_common.albums-list')
			</div>
		</div>

		@include('_common.footer')
	</div>

	{{-- Javascripts --}}

	@include('_common._js')
</body>
@endsection