<form id="edit-user-header" class="hform hide">
  {{csrf_field()}}
  <div class="header-holder header-holder_edit-user" id="bg-edit-user" style="background-image: url({{$user->background}});">
    <div class="fix-width">
      <div class="change-photo change-photo_cover">
        <div class="change-photo__text">
          <label class="link"> <span class="fa fa-camera"> </span>Изменить фон
            <input type="file" name="background" id="input_background" class="form__input form__input_file">
          </label>
        </div>
      </div>
      <div class="user-info-holder">
        <div class="user-avatar">
          <div class="change-photo change-photo_user">
            <div class="change-photo_user__img"><img src="{{$user['avatar']}}" alt="" id="preview_avatar" class="change-photo_user__pic"></div>
            <div class="change-photo__text">
              <label class="link"><span class="fa fa-camera"></span>Изменить фото
                <input type="file" name="avatar" id="input_avatar" class="form__input form__input_file">
              </label>
            </div>
          </div>
        </div>
        <div class="user-info">
          <div class="input-group">
            <input id="" name="name" type="text" class="input_rounded" value="{{$user['name']}}">
          </div>
          <div class="input-group">
            <textarea name="description" cols="30" rows="5" class="input_rounded input_rounded_user-textarea">{{$user['description']}}</textarea>
          </div>

          <!--  Массив для генерации соц иконок-->
          <?php
            $arr_socials = array(
                array('blade'=>'vk', 'svg'=>'vk', 'href'=>'https://vk.com/'),
                array('blade'=>'facebook', 'svg'=>'fb', 'href'=>'https://www.facebook.com/'),
                array('blade'=>'twitter', 'svg'=>'twitter', 'href'=>'https://www.twitter.com/'),
                array('blade'=>'google', 'svg'=>'google', 'href'=>'https://plus.google.com/up/follow'),
                array('blade'=>'email', 'svg'=>'email', 'href'=>'mailto:mail@gmail.com')
            );
          ?>

          <ul class="social-links">

            @foreach($arr_socials as $social)
              <li class="social__item">
                <button class="social__link js-open-social-form">
                  <svg class="svg-social">
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-soc_{{ $social['svg'] }}"></use>
                  </svg>
                </button>
                <div class="social__form">
                  <input id="" name="{{ $social['blade'] }}" type="text" class="input_rounded" value="{{ $user[ $social['blade'] ] }}" data-backup="{{ $user[ $social['blade'] ] }}">
                  <button type="button" class="btn btn_transparent js-close-form">Сохранить</button>
                  <button type="button" class="btn btn_link js-undo-input">Отменить</button>
                </div>
              </li>
            @endforeach

          </ul>

        </div>
      </div>
    </div>
  </div>
  <div class="hform__footer">
    <button type="submit" class="btn btn_ok">Сохранить</button>
    <button class="btn btn_link js-close-header">Отменить</button>
  </div>
</form>