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
	@include('_common.add-photos-modal')
	@include('_common.edit-photo-modal')
	@include('_common.edit-user-modal')
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
							<ul class="social-links">
								<li class="social-links__item">
									<a href="{{$user['vk']}}" id="social__link_vk" class="social-links__link">
										<svg class="social-links__svg">
											<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-soc_vk"></use>
										</svg>
									</a>
								</li>
								<li class="social-links__item">
									<a href="{{$user['facebook']}}" id="social__link_fb" class="social-links__link">
										<svg class="social-links__svg">
											<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-soc_fb"></use>
										</svg>
									</a>
								</li>
								<li class="social-links__item">
									<a href="{{$user['twitter']}}" id="social__link_tw" class="social-links__link">
										<svg class="social-links__svg">
											<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-soc_twitter"></use>
										</svg>
									</a>
								</li>
								<li class="social-links__item">
									<a href="{{$user['google']}}" id="social__link_gg" class="social-links__link">
										<svg class="social-links__svg">
											<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-soc_google"></use>
										</svg>
									</a>
								</li>
								<li class="social-links__item">
									<a href="mailto:{{$user['email']}}" id="social__link_email" class="social-links__link">
										<svg class="social-links__svg">
											<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-soc_email"></use>
										</svg>
									</a>
								</li>
							</ul>
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
				<form class="search-form">
					<div class="search-form-holder">
						<button type="submit" class="search-form__btn fa fa-search"></button>
						<input type="text" placeholder="Исследовать мир" class="search-form__input">
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
						<div class="album-item"
						data-title="{{$photo->title}}"
						data-likes="{{$photo->likes}}"
						data-comments="{{$photo->comments}}"
						data-thumb="{{$photo->thumb_url}}"
						data-user_avatar="{{$photo->user->avatar}}"
						data-user_name="{{$photo->user->name}}"
						data-desc="{{$photo->description}}"
						>
						<div class="album-item-holder">
							<div class="album-photo">
								<a href="#" class="open-img-popup js-open-slider">
									<div class="album-mask"><i class="fa fa-search-plus"></i></div>
									<div class="album-photo__thumb" style="background-image: url('{{$photo->thumb_url}}')"></div>
								</a>
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
								<a href="album.html" class="category-name">
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
											<img src="{{$comment->user->avatar}}" alt="{{$comment->user->name}}"/>
											<a href="user.html" class="photo-user-img__mask">
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

					<h2>Нет фотографий</h2>

					@endforelse


				</div>

				@if(count($photos) > 6)
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

				<div class="album-container">

					@forelse ($albums as $album)

					<div class="album-item">
						<div class="album-item-holder">
							<a href="/album/{{$album['id']}}" class="my-album">
								<img src="{{ ($album->cover->img_url !== '') ? $album->cover->img_url : 'assets/img/no_photo.jpg' }}" alt=""/>

								<div class="album-mask">
									<div class="mask-content">
										<div class="mask-content__desc">Фотографии природы леса, енотов и оленей...</div>
										<div class="mask-content__count"><span>18</span>Фотографий</div>
									</div>
								</div></a>
								<div class="album-category"><a href="#" class="edit-post js-add-album"><i class="fa fa-pencil"></i></a><span class="category-name">Путешествие</span></div>
							</div>
						</div>

						@empty
						<h2>no albums yet</h2>
						@endforelse

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