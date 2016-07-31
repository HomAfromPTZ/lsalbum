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
	@include('_common.add-albums-modal')
	@include('_common.add-photos-modal')
	@include('_common.edit-photo-modal')
	@include('_common.edit-user-modal')
	@include('_common.edit-user-header')
	@include('_common.slider')

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
						<h1 class="my-album-title">{{ $user->title }}</h1>
						<div class="my-album-desc">{{ $user->description }}</div>
					</div>
					<div class="header-buttons">
						<div class="header-buttons__item"><a href="main.html" class="btn btn_animated"><i class="fa fa-home"></i><span>На главную</span></a></div>
						<div class="header-buttons__item">
							<button class="btn btn_animated js-edit-album-header"><i class="fa fa-pencil"></i><span>Редактировать</span></button>
						</div>
					</div>
				</div>
			</div>
		</header>
		<div class="gray-bg">
			<ul class="album-general-info">
				<li><span class="photo-count">{{ $album->photos->count() }} </span>Фотографий</li>
				<li><span class="like-count">{{ $likes_num }} </span>Лайков</li>
				<li><span class="comments-count">{{ $comments_num }} </span>Комментариев</li>
			</ul>
		</div>
		<div class="content">
			<div class="fix-width">
				<div class="new-photos-album">
					<div class="add-album-btn js-add-photos">
						<button class="btn btn_animated"><i class="fa fa-plus"></i><span>Добавить</span></button>
					</div>
					<div class="album-container">

            @forelse ($photos as $photo)
              <div class="album-item single-photo"
                   data-title="{{ $photo->title }}"
                   data-desc="{{ $photo->description }}"
                   data-likes="{{ $photo->likes }}"
                   data-comments="{{ $photo->comments }}"
                   data-thumb="{{ $photo->thumb_url }}"
                   data-user_id="{{ $photo->user->id }}"
                   data-user_avatar="{{ $photo->user->avatar }}"
                   data-user_name="{{ $photo->user->name }}">
                <div class="album-item-holder">
                  <div class="album-photo">
                    <a href="#" class="open-img-popup js-open-slider">
                      <div class="album-mask"><i class="fa fa-search-plus"></i></div>
                      <div style="background-image: url('{{ $photo->thumb_url }}')" class="album-photo__thumb"></div>
                    </a>
                    <div class="photo-info">
                      <button class="photo-info__item">
                        <i class="fa fa-commenting"> </i>
                        <span class="comment-count">{{ $photo->comments }}</span>
                      </button>
                      <button class="photo-info__item">
                        <i class="fa fa-heart"> </i>
                        <span class="like-count">{{ $photo->likes }}</span>
                      </button>
                    </div>
                  </div>
                  <div class="album-category">
                    <a href="#" class="edit-post js-edit-photo">
                      <i class="fa fa-pencil"></i>
                    </a>
                    <span class="category-name">{{ $album->title }}</span>
                  </div>
                </div>

                <div class="is-hidden comments_hidden">


<!--                  TODO: $photo['comments'] -->

                  @forelse ($photos as $comment)
                    <div class="comments__item">
                      <div class="comments__item-photo">
                        <div class="photo-user-img">
                          <img src="/assets/img/default_avatar.jpg" alt="Виталий Виноградов"/>
                          <a href="user.html" class="photo-user-img__mask">
                            <svg class="svg-more">
                              <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-more"></use>
                            </svg>
                          </a>
                        </div>
                      </div>
                      <div class="comments__item-info">
                        <div class="user__name">Виталий Виноградов</div>
                        <div class="comments__item-text">Душа моя озарена неземной радостью, как эти чудесные весенние утра, которыми я наслаждаюсь от всего сердца. Я совсем один и блаженствую в здешнем краю, словно созданном для таких, как я. Я так счастлив, мой друг, так упоен ощущением. Душа моя озарена неземной радостью, как эти чудесные весенние утра, которыми я наслаждаюсь от всего сердца.</div>
                      </div>
                    </div>
                  @empty
                    {{ 'нет комментариев' }}
                  @endforelse

                </div>
              </div>
            @empty
              {{ 'нет фотографий' }}
            @endforelse


					</div>
				</div>
			</div>
		</div>
		<footer>
			<div class="fix-width">
				<div class="footer-content">
					<div class="footer-column left">
						<p>Перед вами сервис, который поможет вам организовать свои фотографии в альбомы и поделиться ими со всем миром!</p>
					</div>
					<div class="footer-column center"><img src="/assets/img/footer-logo.png" id="go-up"></div>
					<div class="footer-column right"><span class="year">2016</span>Создано командой профессионалов на продвинутом курсе по&nbsp;веб-разработке от LoftSchool</div>
				</div>
			</div>
		</footer>
	</div>


<!--<ul>-->
<!--	<li>Url: {{$url}}</li>-->
<!--	<li>Username: {{$user['name']}}</li>-->
<!--	<li>User avatar: {{$user['avatar']}}</li>-->
<!--	<li>Album title: {{$album['title']}}</li>-->
<!--	<li>Описание: {{$album['description']}}</li>-->
<!--	<li>Обложка: {{$album->cover->img_url}}</li>-->
<!--	<li>All Photos: {{$photos_num}}</li>-->
<!--	<li>All Likes: {{$likes_num}}</li>-->
<!--	<li>All Comments: {{$comments_num}}</li>-->
<!--</ul>-->
<!--	<h2>Фотографии:</h2>-->
<!--	@forelse ($photos as $photo)-->
<!--		<hr>-->
<!--		<ul>-->
<!--			<li>Photo thumb: <br/><img width="200" src="{{$photo['thumb_url']}}"/></li>-->
<!--			<li>Photo img: {{$photo['img_url']}}</li>-->
<!--			<li>Title: {{$photo['title']}}</li>-->
<!--			<li>Description: {!!preg_replace("/(#(\w{3,}))/", "<a href='/search/?searchtext=$2&hashtag=true'>$1</a>", $photo->description)!!}</li>-->
<!--			<li>Likes: {{$photo['likes']}}</li>-->
<!--			<li>Comments: {{$photo['comments']}}</li>-->
<!--		</ul>-->
<!--	@empty-->
<!--		{{-- empty expr --}}-->
<!--	@endforelse-->

{{-- Javascripts --}}

@include('_common._js')

</body>
@endsection
