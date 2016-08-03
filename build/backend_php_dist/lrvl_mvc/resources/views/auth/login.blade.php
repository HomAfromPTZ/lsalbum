@extends('layouts.app')

@section('title', 'Вход на сайт' )

@section('head')
  @include('_common.head')
@endsection

@section('content')
@include('_common.sprites')
@include('_common.preloader')
@include('_common.popup')
@include('_common.parallax')

<!--[if lt IE 9]>
<p class="browsehappy">Вы используете <strong>устаревший</strong> браузер. Пожалуйста <a href="http://browsehappy.com/">обновите его</a></p>
<![endif]-->
<div class="welcome__wrapper">
    <div class="welcome__flip-wrapper">
        <div class="flip-container">
            <div class="flip-card">
                <div class="flip-card__front-side">
                    <div class="welcome__intro welcome__intro_login active">
                        <h1 class="welcome__h1">Добро пожаловать</h1>
                        <div class="welcome__text">Перед вами сервис, который поможет вам организовать свои фотографии в&nbsp;альбомы и&nbsp;поделиться ими со&nbsp;всем миром!</div>
                    </div>
                    <div class="welcome__card welcome__card_login">
                        <form id="form_welcome" class="form form_welcome" role="form" method="POST" action="{{ url('/login') }}">
                          {{ csrf_field() }}
                            <div class="input-group_welcome"><span class="group_welcome__icon"><i aria-hidden="true" class="fa fa-user"></i></span>
                                <input type="text" name="email" class="group_welcome__input" placeholder="Электронная почта" value="{{ old('email') }}">
                            </div>
                            <div class="input-group_welcome input-group_last"><span class="group_welcome__icon"><i aria-hidden="true" class="fa fa-lock"></i></span>
                                <input name="password" type="password" placeholder="Пароль" class="group_welcome__input">
                            </div>
                            <div class="form_welcome__text"><a id="show-recovery" href="{{ url('/password/reset') }}" class="form_welcome__link">Забыли пароль?</a></div>
                            <div class="form_welcome__text">
                              @if ($errors->has('email'))
                                <div class="error-notification">E-mail или пароль не верен</div>
                              @endif
                            </div>
                            <div class="form_welcome__text form_welcome__text_button">
                                <input type="submit" value="Войти" class="form_welcome__button btn btn_ok">
                            </div>
                            <div class="form_welcome__text form_welcome__text_center">
                              <span class="form_welcome__span">Нет аккаунта?</span>
                              <a id="flip-card" href="#" class="form_welcome__link">Зарегистрироваться</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="flip-card__back-side">
                    <div class="welcome__intro welcome__intro_registration">
                        <h1 class="welcome__h1">Регистрация</h1>
                    </div>
                    <div class="welcome__card welcome__card_registration">
                        <form class="form form_welcome" method="POST" action="{{ url('/register') }}">
                          {{ csrf_field() }}
                            <div class="input-group_welcome"><span class="group_welcome__icon"><i aria-hidden="true" class="fa fa-user"></i></span>
                                <input id="" name="name" type="text" placeholder="Имя" class="group_welcome__input" value="{{ old('name') }}">
                            </div>
                            <div class="input-group_welcome"><span class="group_welcome__icon"><i aria-hidden="true" class="fa fa-envelope"></i></span>
                                <input id="" name="email" type="email" placeholder="Электронная почта" class="group_welcome__input" value="{{ old('email') }}">
                            </div>
                            <div class="input-group_welcome input-group_last"><span class="group_welcome__icon"><i aria-hidden="true" class="fa fa-lock"></i></span>
                                <input id="" name="password" type="password" placeholder="Пароль" class="group_welcome__input">
                            </div>
                            <div class="form_welcome__text">
                                <div class="form_welcome__span">Ваши данные остаются строго конфиденциальны</div>
                            </div>
                            <div class="form_welcome__text">
                              @if ($errors->has('name'))
                                <div class="error-notification">Введите имя</div>
                              @elseif ($errors->has('email'))
                                <div class="error-notification">Введите e-mail</div>
                              @elseif ($errors->has('password'))
                                <div class="error-notification">Введите пароль</div>
                              @elseif ($errors->has('password_confirmation'))
                                <div class="error-notification">Неверный повторно введеный пароль</div>
                              @endif
                            </div>
                            <div class="form_welcome__text form_welcome__text_button">
                                <input type="submit" id="" value="Создать аккаунт" class="form_welcome__button btn btn_ok">
                            </div>
                            <div class="form_welcome__text form_welcome__text_center">
                              <span class="form_welcome__span">Уже зарегистрированы? </span>
                              <a id="unflip-card" href="#" class="form_welcome__link">Войти</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="flip-card__recovery">
                    <div class="welcome__intro">
                        <h1 class="welcome__h1">Восстановление пароля</h1>
                    </div>
                    <div class="welcome__card">
                        <form method="post" class="form form_welcome form_recovery" action="{{ url('/password/email') }}">
                            {{ csrf_field() }}
                            <div class="form_welcome__text">
                                <div class="form_welcome__span form_welcome__span_bold">Забыли пароль?</div>
                            </div>
                            <div class="form_welcome__text">
                                <div class="form_welcome__span">Ничего страшного, введите свой e-mail, и мы вышлем вам инструкции по востановлению пароля</div>
                            </div>
                            <div class="input-group_welcome input-group_last"><span class="group_welcome__icon"><i aria-hidden="true" class="fa fa-envelope"></i></span>
                                <input id="email" name="email" type="email" placeholder="Электронная почта" class="group_welcome__input" value="{{ old('email') }}">
                            </div>
                            <div class="form_welcome__text">
                              @if ($errors->has('email'))
                                <div class="error-notification">Пользователя с указанной электронной почтой не существует</div>
                              @endif
                            </div>
                            <div class="form_welcome__text form_welcome__text_button">
                                <input type="submit" id="" value="Восстановить пароль" class="form_welcome__button btn btn_ok">
                            </div>
                            <div class="form_welcome__text form_welcome__text_center">
                              <span class="form_welcome__span">Вспомнили пароль? </span>
                              <a id="hide-recovery" href="#" class="form_welcome__link">Войти</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <div class="welcome__footer">
        <div class="welcome__footer-text">2016 Создано командой профессионалов на продвинутом курсе по веб-разработке от LoftSchool</div>
    </div>
</div>

  {{-- Javascripts --}}

  @include('_common._js')

@endsection
