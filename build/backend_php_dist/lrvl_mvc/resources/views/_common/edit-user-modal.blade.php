<div id="edit-user-modal" class="hm-modal">
  <div class="hm-modal__container">
    <div class="hm-modal__content">
      <div class="hm-modal__header">
        <div class="hm-modal__title">Редактировать профиль</div>
        <button class="hm-modal__close js-close-modal"><span class="fa fa-close"></span></button>
      </div>
      <form method="post" class="form">
        <div class="hm-modal__text">
          <div class="input-group">
            <label class="label_left">Имя</label>
            <input id="" name="" type="text" class="input_rounded" value="{{$user['name']}}">
          </div>
          <div class="input-group">
            <label class="label_left">О себе</label>
            <textarea name="" cols="30" rows="5" class="input_rounded"></textarea>
          </div>
          <div class="input-group input-group_upload">
            <div class="image-preview-holder">
              <div class="image-preview"><img src="/assets/img/default_avatar.jpg" alt="" class="image-preview__pic"></div>
            </div>
            <label class="file-label btn btn_transparent">Загрузить фотографию
              <input type="file" name="" class="form__input form__input_file">
            </label>
            <div class="form__notice">(файл должен быть размером не&nbsp;более 512&nbsp;КБ)</div>
          </div>
          <div class="input-group input-group_upload">
            <div class="image-preview-holder">
              <div class="image-preview"><img src="/assets/img/no_photo.jpg" alt="" class="image-preview__pic"></div>
            </div>
            <label class="file-label btn btn_transparent">Загрузить фон
              <input type="file" name="" class="form__input form__input_file">
            </label>
            <div class="form__notice">(файл должен быть размером не&nbsp;более 1024&nbsp;КБ)</div>
          </div>
          <div class="input-group">
            <label class="label_left">Вконтакте</label>
            <input id="" name="" type="text" class="input_rounded">
          </div>
          <div class="input-group">
            <label class="label_left">Facebook</label>
            <input id="" name="" type="text" class="input_rounded">
          </div>
          <div class="input-group">
            <label class="label_left">Email</label>
            <input id="" name="" type="text" class="input_rounded">
          </div>
          <div class="input-group">
            <label class="label_left">Twitter</label>
            <input id="" name="" type="text" class="input_rounded">
          </div>
        </div>
        <div class="hm-modal__footer">
          <button class="btn btn_ok">Сохранить</button>
          <button class="btn btn_link js-close-modal">Отменить</button>
        </div>
      </form>
    </div>
  </div>
</div>