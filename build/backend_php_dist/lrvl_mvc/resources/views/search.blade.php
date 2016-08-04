@extends('layouts.app')

@section('title', 'Страница поиска' )

@section('head')
@include('_common.head')
@endsection

@section('content')
<body class="search-page">
	@include('_common.sprites')
	@include('_common.preloader')
	@include('_common.popup')
	@include('_common.edit-photo-modal')
	@include('_common.slider')
	@include('_templates.comment-item-template')
	@include('_templates.photo-item-template')

	<div class="page">
		<header class="header header_search">
			<div class="header-holder">
				<div class="fix-width">
					<h1 class="seach-page-title">Исследуй мир</h1>

					<div class="header-buttons">
						<div class="header-buttons__item">
							<a href="/" class="btn btn_animated btn__logut preload-link">
								<i class="fa fa-home"></i>
								<span>На главную</span>
							</a>
						</div>
					</div>

				</div>
			</div>
		</header>
		<div class="search-holder">
			<div class="fix-width">

				<div class="user-info-holder">
					<div class="user-avatar">
						<div class="user-avatar__img"><img src="assets/img/default_avatar.jpg"/></div>
					</div>
					<div class="user-info">
						<h3 class="user-info__name">Антон Черепов</h3>
					</div>
				</div>

				<form class="search-form" action="/search">
					<button type="submit" class="search-form__btn fa fa-search"></button>
					<input name="searchtext" type="text" placeholder="Исследовать мир" class="search-form__input"/>
				</form>

				<a href="#" class="show-new">Показать новые</a>

			</div>
		</div>
		<div class="content">
			<div class="fix-width">
				<div class="new-photos-album">
					<h3 class="search-results-title">
						{{$message}}
					</h3>

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