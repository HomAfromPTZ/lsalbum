<form id="edit-user-header" class="hform hide">
  {{csrf_field()}}
  <div class="header-holder header-holder_edit-user" id="bg-edit-user"
       style="background-image: url({{$user->background}});"
       data-backup="{{$user->background}}">
    <div class="fix-width">
      <div class="user-info-holder">
        <div class="user-avatar">
          <div class="change-photo change-photo_user">
            <div class="change-photo_user__img">
              <img src="{{$user['avatar']}}" alt="" id="preview_avatar" class="change-photo_user__pic"
                   data-backup="{{$user['avatar']}}">
            </div>
            <div class="change-photo__text">
              <label class="link"><span class="fa fa-camera"></span>Изменить фото
                <input type="file" name="avatar" id="input_avatar" class="form__input form__input_file">
              </label>
            </div>
          </div>
        </div>
        <div class="user-info">
          <div class="input-group">
            <input id="" name="name" type="text" class="input_rounded"
                   value="{{$user['name']}}"
                   data-backup="{{ $user['name'] }}">
          </div>
          <div class="input-group">
            <textarea name="description" cols="30" rows="5" class="input_rounded input_rounded_user-textarea"
                      data-backup="{{ $user['description'] }}">{{$user['description']}}</textarea>
          </div>

          <!--  Массив для генерации соц иконок-->
          <?php
            $arr_socials = array(
                array('blade'=>'vk', 'svg'=>'vk'),
                array('blade'=>'facebook', 'svg'=>'fb'),
                array('blade'=>'twitter', 'svg'=>'twitter'),
                array('blade'=>'google', 'svg'=>'google'),
                array('blade'=>'email', 'svg'=>'email')
            );
          ?>

          <ul class="social-links">

            @foreach($arr_socials as $social)
              <li class="social-links__item">
                <a href="#" id="" class="social-links__link js-open-social-form">
                  <svg class="social-links__svg">
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-soc_{{ $social['svg'] }}"></use>
                  </svg>
                </a>
                <div class="social-links__form">
                  <input name="{{ $social['blade'] }}" type="text" class="input_rounded"
                         value="{{ $user[ $social['blade'] ] }}"
                         data-backup="{{ $user[ $social['blade'] ] }}">
                  <button type="button"  class="btn btn_transparent js-close-form">Сохранить</button>
                  <button type="button"  class="btn btn_link js-undo-input">Отменить</button>
                </div>
              </li>
            @endforeach

          </ul>
        </div>
      </div>
      <div class="change-photo change-photo_cover">
        <div class="change-photo__text">
          <label class="link"> <span class="fa fa-camera"> </span>Изменить фон
            <input type="file" name="background" id="input_background" class="form__input form__input_file">
          </label>
        </div>
      </div>
    </div>
  </div>
  <div class="hform__footer">
    <button type="submit" class="btn btn_ok js-close-header">Сохранить</button>
    <button type="button" class="btn btn_link js-close-header">Отменить</button>
  </div>
</form>