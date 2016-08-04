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

<div class="page">
    <header class="header header_user">
        <div class="header-holder">
            <div class="fix-width">
                <div class="user-info-holder">

                    <div class="user-avatar">
                        <div class="user-avatar__img">
                          <img src="{{ ($user->avatar !== '') ? $user->avatar : 'assets/img/default_avatar.jpg' }}"/>
                        </div>
                    </div>

                    <div class="user-info">
                        <h3 class="user-info__name">{{ $user->name }}</h3>
                        <div class="user-info__desc">{{ $user->description }}</div>

                        @include('_common.show-socials')

                    </div>
                </div>
                <div class="header-buttons">
                    <div class="header-buttons__item">
                      <a href="/" class="btn btn_animated preload-link">
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
            <form class="search-form" action="/search">
                <button type="submit" class="search-form__btn fa fa-search"></button>
                <input name="q" type="text" placeholder="Исследовать мир" class="search-form__input"/>
            </form>
        </div>
    </div>
    <div class="content">
        <div class="my-photos">
            <div class="fix-width">
                <div class="title-holder">
                    <h2 class="album-title">Альбомы</h2>
                </div>
                @include('_common.albums-list')
            </div>
        </div>
    </div>
  
    @include('_common.footer')
</div>

{{-- Javascripts --}}

@include('_common._js')

</body>
@endsection