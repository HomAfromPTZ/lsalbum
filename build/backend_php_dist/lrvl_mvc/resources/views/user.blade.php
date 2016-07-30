@extends('layouts.app')

@section('title', 'Страница - '.$user['name'] )

@section('head')
@include('_common.head')
@endsection

@section('content')
<body class="user-page">
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
              <div class="user-avatar__img"><img src="{{ ($user->avatar !== '') ? $user->avatar : 'assets/img/default_avatar.jpg' }}"/></div>
            </div>

            <div class="user-info">
              <h2 class="user-info__name">{{ $user->name }}</h2>
              <div class="user-info__desc">{{ $user->description }}</div>
              <ul class="social-links">
                <li class="social__item"><a href="{{ $user->vk }}" id="social__link_vk" class="social__link">
                    <svg class="svg-social">
                      <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-soc_vk"></use>
                    </svg></a></li>
                <li class="social__item"><a href="{{ $user->facebook }}" id="social__link_fb" class="social__link">
                    <svg class="svg-social">
                      <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-soc_fb"></use>
                    </svg></a></li>
                <li class="social__item"><a href="{{ $user->twitter }}" id="social__link_tw" class="social__link">
                    <svg class="svg-social">
                      <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-soc_twitter"></use>
                    </svg></a></li>
                <li class="social__item"><a href="{{ $user->google }}" id="social__link_gg" class="social__link">
                    <svg class="svg-social">
                      <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-soc_google"></use>
                    </svg></a></li>
                <li class="social__item"><a href="mailto:{{ $user->email }}" id="social__link_email" class="social__link">
                    <svg class="svg-social">
                      <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-soc_email"></use>
                    </svg></a></li>
              </ul>
            </div>
          </div>

          <div class="header-buttons">
            <div class="header-buttons__item"><a href="main.html" class="btn btn_animated"><i class="fa fa-home"></i><span>На главную</span></a></div>
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
      <div class="my-photos">
        <div class="fix-width">
          <div class="title-holder">
            <h2 class="album-title">Альбомы</h2>
          </div>
          <div class="album-container">

<!-- TODO вывод альбомов-->
            <div class="album-item">
              <div class="album-item-holder"><a href="album.html" class="my-album"><img src="/assets/img/no_photo.jpg" alt=""/>
                  <div class="album-mask">
                    <div class="mask-content">
                      <div class="mask-content__desc">Фотографии природы леса, енотов и оленей...</div>
                      <div class="mask-content__count"><span>18</span>Фотографий</div>
                    </div>
                  </div></a>
                <div class="album-category"><a href="#" class="edit-post js-add-album"><i class="fa fa-pencil"></i></a><span class="category-name">Путешествие</span></div>
              </div>
            </div>

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


  -----------------------------------------
  <ul>
    <li>Имя: {{$user['name']}}</li>
    <li>Описание: {{$user['description']}}</li>
    <li>Email: {{$user['email']}}</li>
    <li>Vk: {{$user['vk']}}</li>
    <li>Facebook: {{$user['facebook']}}</li>
    <li>Twitter: {{$user['twitter']}}</li>
    <li>Google: {{$user['google']}}</li>
    <li>Instagram: {{$user['instagram']}}</li>
    <li>Avatar:<br/><img width="100" src="{{$user['avatar']}}"/></li>
    <li>Background:<br/><img width="100" src="{{$user['background']}}"/></li>
  </ul>
  <h2>Альбомы</h2>
  @forelse ($albums as $album)
  <div>
    =======================================
    <ul>
      <li>Id: {{$album['id']}}</li>
      <li>Title: {{$album['title']}}</li>
      <li>Description: {{$album['description']}}</li>
      <li>Cover_id: {{$album['cover_id']}}</li>
      <li>User_id: {{$album['user_id']}}</li>
      <li>Cover:<br/>
        <img width="100" src="{{$album->cover->img_url}}"/>
      </li>
    </ul>
    =======================================
  </div>
  @empty
  {{-- empty expr --}}
  @endforelse


{{-- Javascripts --}}

@include('_common._js')

</body>
@endsection



