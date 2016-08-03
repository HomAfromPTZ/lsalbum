<div id="add-album-modal" class="hm-modal hide">
  <div class="hm-modal__container">
    <div class="hm-modal__content">
      <div class="hm-modal__header">
        <div class="hm-modal__title">Добавить альбом</div>
        <button class="hm-modal__close js-close-modal"><span class="fa fa-close"></span></button>
      </div>

      <form id="form-add-album" class="form">
        {{csrf_field()}}
        <div class="hm-modal__text">
          <div class="input-group">
            <label class="label_left">Название</label>
            <input id="" name="title" type="text" placeholder="Название альбома" class="input_rounded">
          </div>
          <div class="input-group">
            <label class="label_left">Описание</label>
            <textarea name="description" cols="30" rows="10" placeholder="Описание альбома" class="input_rounded"></textarea>
          </div>
          <div class="input-group input-group_upload">
            <div class="image-preview-holder">
              <div class="image-preview">
                <img src="/assets/img/no_photo.jpg" alt="" class="image-preview__pic" id="add-album-preview"></div>
            </div>
            <label class="file-label btn btn_transparent">Загрузить обложку
              <input type="file" name="cover" class="form__input form__input_file" id="add-album-cover">
            </label>
            <div class="form__notice">(файл должен быть размером не&nbsp;более 1024&nbsp;КБ)</div>
          </div>
        </div>
        <div class="hm-modal__footer">
          <button class="btn btn_ok">Сохранить</button>
          <button class="btn btn_link js-close-modal">Отменить</button>
<!--          <button class="btn btn_red"><span class="fa fa-trash"></span><span>Удалить</span></button>-->
        </div>
      </form>
    </div>
  </div>
</div>