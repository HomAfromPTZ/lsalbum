<form id="edit-user-header" class="hform hide">
  {{csrf_field()}}
  <div class="header-holder header-holder_edit-user" id="bg-edit-user" style="background-image: url({{$user->background}});">
    <div class="fix-width">
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
          <ul class="social-links">
            <li class="social-links__item"><a href="https://vk.com/" id="" class="social-links__link js-open-social-form">
                <svg class="social-links__svg">
                  <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-soc_vk"></use>
                </svg></a>
              <div class="social-links__form">
                <input id="" name="vk" type="text" class="input_rounded" value="{{$user['vk']}}">
                <button class="btn btn_transparent">Сохранить</button>
                <button class="btn btn_link js-close-form">Отменить</button>
              </div>
            </li>
            <li class="social-links__item"><a href="https://www.facebook.com/" id="" class="social-links__link js-open-social-form">
                <svg class="social-links__svg">
                  <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-soc_fb"></use>
                </svg></a>
              <div class="social-links__form">
                <input id="" name="facebook" type="text" class="input_rounded" value="{{$user['facebook']}}">
                <button class="btn btn_transparent">Сохранить</button>
                <button class="btn btn_link js-close-form">Отменить</button>
              </div>
            </li>
            <li class="social-links__item"><a href="https://twitter.com/?lang=en" id="" class="social-links__link js-open-social-form">
                <svg class="social-links__svg">
                  <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-soc_twitter"></use>
                </svg></a>
              <div class="social-links__form">
                <input id="" name="twitter" type="text" class="input_rounded" value="{{$user['twitter']}}">
                <button class="btn btn_transparent">Сохранить</button>
                <button class="btn btn_link js-close-form">Отменить</button>
              </div>
            </li>
            <li class="social-links__item"><a href="https://plus.google.com/up/follow" id="" class="social-links__link js-open-social-form">
                <svg class="social-links__svg">
                  <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-soc_google"></use>
                </svg></a>
              <div class="social-links__form">
                <input id="" name="google" type="text" class="input_rounded" value="{{$user['google']}}">
                <button class="btn btn_transparent">Сохранить</button>
                <button class="btn btn_link js-close-form">Отменить</button>
              </div>
            </li>
            <li class="social-links__item"><a href="mailto:mail@gmail.com" id="" class="social-links__link js-open-social-form">
                <svg class="social-links__svg">
                  <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-soc_email"></use>
                </svg></a>
              <div class="social-links__form">
                <input id="" name="email" type="text" class="input_rounded" value="{{$user['email']}}">
                <button type="button" class="btn btn_transparent">Сохранить</button>
                <button type="button" class="btn btn_link js-close-form">Отменить</button>
              </div>
            </li>
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
    <button type="submit" class="btn btn_ok">Сохранить</button>
    <button class="btn btn_link js-close-header">Отменить</button>
  </div>
</form>