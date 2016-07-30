@extends('layouts.app')

@section('title', 'Альбом - '.$album->title )

@section('head')
  @include('_common.head')
@endsection

@section('content')
<body class="my-album-page">
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
  <header class="main-page">
    <div class="header-holder">
      <div class="fix-width">
        <div class="user-info-holder">
          <div class="user-avatar">
            <div class="user-avatar__img">
              <img src="{{ ($user->avatar !== '') ? $user->avatar : 'assets/img/default_avatar.jpg' }}"/>
            </div>
          </div>
          <div class="user-info">
            <h2 class="user-info__name">{{ $user->name }}</h2>
          </div>
        </div>
        <div class="header-content">
          <h3 class="my-album-title">{{ $album->title }}</h3>
          <div class="my-album-desc">{{ $album->description }}</div>
        </div>
        <div class="header-buttons">
          <div class="header-buttons__item"><a href="/" class="btn btn_animated"><i class="fa fa-home"></i><span>На главную</span></a></div>
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
            <div class="album-item single-photo" data-title="{{ $photo->title }}" data-desc="{{ $photo->description }}" data-likes="{{ $photo->likes }}" data-comments="{{ $photo->comments }}" data-thumb="{{ $photo->thumb_url }}" data-user_avatar="{{ $photo->user->avatar }}" data-user_name="{{ $photo->user->name }}">
              <div class="album-item-holder">
                <div class="album-photo">
                  <a href="#" class="open-img-popup js-open-slider">
                    <div class="album-mask"><i class="fa fa-search-plus"></i></div>
                    <div style="background-image: url('{{ $album->cover->img_url }}')" alt="" class="album-photo__thumb"></div>
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
                  <span class="category-name">{{ $photo->title }}</span>
                </div>
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
        <div class="footer-column">
          <p>Перед вами сервис, который поможет вам организовать свои фотографии в альбомы и поделиться ими со всем миром!</p>
        </div>
        <div class="footer-column center"><img src="/assets/img/footer-logo.png"></div>
        <div class="footer-column right"><span class="year">2016</span>Создано командой профессионалов на продвинутом курсе по&nbsp;веб-разработке от LoftSchool</div>
      </div>
    </div>
  </footer>

</div>

{{-- Javascripts --}}

@include('_common._js')

</body>
@endsection