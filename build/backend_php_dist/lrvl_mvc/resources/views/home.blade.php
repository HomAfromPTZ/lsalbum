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

						@forelse ($photos as $photo)
						<div class="photo-item"
						data-title="{{$photo->title}}"
						data-likes="{{$photo->likes}}"
						data-comments="{{$photo->comments}}"
						data-thumb="{{$photo->thumb_url}}"
						data-user_id="{{ $photo->user->id }}"
						data-user_avatar="{{($photo->user->avatar !== "") ?  $photo->user->avatar : '/assets/img/default_avatar.jpg'}}"
						data-user_name="{{$photo->user->name}}"
						data-desc="{!!preg_replace("/(#(\w{3,}))/", "<a href='/search/?searchtext=%23$2'>$1</a>", $photo->description)!!}">
						<div class="photo-item-holder">
							<div class="album-photo">
								<div class="open-img-popup js-open-slider">
									<div class="album-mask"><i class="fa fa-search-plus"></i></div>
									<div class="album-photo__thumb" style="background-image: url('{{$photo->thumb_url}}')"></div>
								</div>
							</div>
							<div class="album-desc">
								<div class="album-desc__user">
									<div class="photo-user-img">
										<img src="{{$photo->user->avatar}}"/>
										<a href="/user/{{$photo->user->id}}" class="photo-user-img__mask">
											<svg class="svg-more">
												<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-more"></use>
											</svg>
										</a>
									</div>
								</div>
								<div class="album-desc__info">
									<div class="photo-desc-title">{{$photo->title}}</div>
									<div class="photo-info">
										<button class="photo-info__item">
											<i class="fa fa-commenting"> </i>
											<span class="comment-count">{{$photo->comments}}</span>
										</button>
										<button class="photo-info__item">
											<i class="fa fa-heart"> </i>
											<span class="like-count">{{$photo->likes}}</span>
										</button>
									</div>
								</div>
							</div>
							<div class="album-category">
								<a href="/album/{{ $photo->album->id }}" class="category-name">
									<svg class="svg-category">
										<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-album"></use>
									</svg>
									<span>{{$photo->album->title}}</span>
								</a>
							</div>
							<div class="is-hidden comments_hidden">

								@forelse ($photo->comment as $comment)
								<div class="comments__item">
									<div class="comments__item-photo">
										<div class="photo-user-img">
											<img src="{{ $comment->user->avatar }}" alt="{{ $comment->user->name }}"/>
											<a href="/user/{{ $comment->user->id }}" class="photo-user-img__mask">
												<svg class="svg-more">
													<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-more"></use>
												</svg>
											</a>
										</div>
									</div>
									<div class="comments__item-info">
										<div class="user__name">{{$comment->user->name}}</div>
										<div class="comments__item-text">{{$comment->content}}</div>
									</div>
								</div>
								@empty
									Нет комментариев
								@endforelse

							</div>
						</div>
					</div>

					@empty

					<h3>Нет фотографий</h3>

					@endforelse


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

				@if($albums->count()>0)
					<div class="album-container">
					@foreach ($albums as $album)
						<div class="album-item" data-id="{{ $album->id }}">
							<div class="album-item-holder">
								<a href="/album/{{$album['id']}}" class="my-album">
									<img src="{{ ($album->cover->img_url !== '') ? $album->cover->img_url : 'assets/img/no_photo.jpg' }}" alt="{{$album->title}}"/>

									<div class="album-mask">
										<div class="mask-content">
											<div class="mask-content__desc">{{$album->description}}</div>
											<div class="mask-content__count">
												<span>{{$album->photos->count()}} </span>Фотографий
											</div>
										</div>
									</div>
								</a>
								<div class="album-category">
									<button class="edit-post js-edit-album">
										<i class="fa fa-pencil"></i>
									</button>
									<span class="category-name">{{ $album->title }}</span>
								</div>
							</div>
						</div>
					@endforeach
					</div>
				@else
					<h3>Альбомов пока еще нет</h3>
				@endif

			</div>
		</div>

		@include('_common.footer')
	</div>

	{{-- Javascripts --}}

	@include('_common._js')
</body>
@endsection