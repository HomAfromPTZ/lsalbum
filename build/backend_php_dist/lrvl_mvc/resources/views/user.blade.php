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
                      <a href="/" class="btn btn_animated">
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
                <div class="album-container">

                  @forelse ($albums as $album)
                    <div class="album-item">
                        <div class="album-item-holder">
                          <a href="/album/{{ $album->id }}" class="my-album">
                            <img src="{{ $album->cover->img_url }}" alt=""/>
                            <div class="album-mask">
                                <div class="mask-content">
                                    <div class="mask-content__desc">{{ $album->title }}</div>
                                    <div class="mask-content__count"><span>{{ $album->photos->count() }}</span> Фотографий</div>
                                </div>
                            </div>
                          </a>
                            <div class="album-category">
                              <a href="/album/edit" class="edit-post js-add-album">
                                <i class="fa fa-pencil"></i>
                              </a>
                              <span class="category-name">Путешествие</span>
                            </div>
                        </div>
                    </div>
                  @empty
                      {{ 'нет фльбомов' }}
                  @endforelse

                </div>
            </div>
        </div>
    </div>
  
    @include('_common.footer')
</div>




<!--    <ul>-->
<!--        <li>Имя: {{$user['name']}}</li>-->
<!--        <li>Описание: {{$user['description']}}</li>-->
<!--        <li>Email: {{$user['email']}}</li>-->
<!--        <li>Vk: {{$user['vk']}}</li>-->
<!--        <li>Facebook: {{$user['facebook']}}</li>-->
<!--        <li>Twitter: {{$user['twitter']}}</li>-->
<!--        <li>Google: {{$user['google']}}</li>-->
<!--        <li>Instagram: {{$user['instagram']}}</li>-->
<!--        <li>Avatar:<br/><img width="100" src="{{$user['avatar']}}"/></li>-->
<!--        <li>Background:<br/><img width="100" src="{{$user['background']}}"/></li>-->
<!--    </ul>-->
<!--    <h2>Альбомы</h2>-->
<!--    @forelse ($albums as $album)-->
<!--        <div>-->
<!--        =======================================-->
<!--        <ul>-->
<!--            <li>Id: {{$album['id']}}</li>-->
<!--            <li>Title: {{$album['title']}}</li>-->
<!--            <li>Description: {{$album['description']}}</li>-->
<!--            <li>Cover_id: {{$album['cover_id']}}</li>-->
<!--            <li>User_id: {{$album['user_id']}}</li>-->
<!--            <li>Cover:<br/>-->
<!--            <img width="100" src="{{$album->cover->img_url}}"/>-->
<!--            </li>-->
<!--        </ul>-->
<!--        =======================================-->
<!--        </div>-->
<!--    @empty-->
<!--        {{-- empty expr --}}-->
<!--    @endforelse-->

{{-- Javascripts --}}

@include('_common._js')

</body>
@endsection