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
  @include('_common.add-albums-modal')
  @include('_common.add-photos-modal')
  @include('_common.edit-photo-modal')

  <div class="page">
    <header class="header header_search">
      <div class="header-holder">
        <div class="fix-width">
          <h1 class="seach-page-title">Исследуй мир</h1>

          <div class="header-buttons">
            <div class="header-buttons__item">
              <a href="/" class="btn btn_animated btn__logut">
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
          <input name="q" type="text" placeholder="Исследовать мир" class="search-form__input"/>
        </form>

        <a href="#" class="show-new">Показать новые</a>

      </div>
    </div>
    <div class="content">
      <div class="fix-width">
        <div class="new-photos-album">
          <h3 class="search-results-title">По запросу &laquo;{{ $_GET['q'] }}&raquo; найдено * результатов:</h3>

          <div class="album-container">



            <div data-title="Путешествие на лодке по озеру" data-likes="10" data-comments="10" data-thumb="assets/img/no_photo.jpg" data-user_avatar="assets/img/default_avatar.jpg" data-user_name="Анна Богданова" data-desc="Мы отправились в #путешествие" class="album-item">
              <div class="album-item-holder">
                <div class="album-photo"><a href="#" class="open-img-popup js-open-slider">
                    <div class="album-mask"><i class="fa fa-search-plus"></i></div>
                    <div style="background-image: url('assets/img/no_photo.jpg')" alt="" class="album-photo__thumb"></div></a></div>
                <div class="album-desc">
                  <div class="album-desc__user">
                    <div class="photo-user-img"><img src="assets/img/default_avatar.jpg" alt=""/><a href="user.html" class="photo-user-img__mask">
                        <svg class="svg-more">
                          <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-more"></use>
                        </svg></a></div>
                  </div>
                  <div class="album-desc__info">
                    <div class="photo-desc-title">Путешествие на лодке по озеру</div>
                    <div class="photo-info">
                      <button class="photo-info__item"><i class="fa fa-commenting"> </i><span class="comment-count">10</span></button>
                      <button class="photo-info__item"><i class="fa fa-heart"> </i><span class="like-count">10</span></button>
                    </div>
                  </div>
                </div>
                <div class="album-category"><a href="album.html" class="category-name">
                    <svg class="svg-category">
                      <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-album"></use>
                    </svg><span>Прогулки по воде</span></a></div>
                <div class="is-hidden comments_hidden">
                  <div class="comments__item">
                    <div class="comments__item-photo">
                      <div class="photo-user-img"><img src="assets/img/default_avatar.jpg" alt="Виталий Виноградов"/><a href="user.html" class="photo-user-img__mask">
                          <svg class="svg-more">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-more"></use>
                          </svg></a></div>
                    </div>
                    <div class="comments__item-info">
                      <div class="user__name">Виталий Виноградов</div>
                      <div class="comments__item-text">Душа моя озарена неземной радостью, как эти чудесные весенние утра, которыми я наслаждаюсь от всего сердца. Я совсем один и блаженствую в здешнем краю, словно созданном для таких, как я. Я так счастлив, мой друг, так упоен ощущением. Душа моя озарена неземной радостью, как эти чудесные весенние утра, которыми я наслаждаюсь от всего сердца.</div>
                    </div>
                  </div>
                  <div class="comments__item">
                    <div class="comments__item-photo">
                      <div class="photo-user-img"><img src="assets/img/default_avatar.jpg" alt="Татьяна Литвинова"/><a href="user.html" class="photo-user-img__mask">
                          <svg class="svg-more">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-more"></use>
                          </svg></a></div>
                    </div>
                    <div class="comments__item-info">
                      <div class="user__name">Татьяна Литвинова</div>
                      <div class="comments__item-text">Душа моя озарена неземной радостью, как эти чудесные весенние утра, которыми я наслаждаюсь от всего сердца. Я совсем один и блаженствую в здешнем краю, словно созданном для таких, как я. Я так счастлив, мой друг, так упоен ощущением. Душа моя озарена неземной радостью, как эти чудесные весенние утра, которыми я наслаждаюсь от всего сердца.</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

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