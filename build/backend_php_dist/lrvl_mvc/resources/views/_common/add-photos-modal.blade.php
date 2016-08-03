<div id="add-photos-modal" class="hm-modal">
  <div class="hm-modal__container">
    <div class="hm-modal__content">
      <div class="hm-modal__header">
        <div class="hm-modal__title">Добавить фотографии</div>
        <button class="hm-modal__close js-close-modal"><span class="fa fa-close"></span></button>
      </div>
      <form method="post" class="form form_add-photo" action="{{ url('/photo/save/'.$album->id) }}">
        {{ csrf_field() }}
        <div class="hm-modal__text">
          <div class="form_add-photo__row">
            <span class="form_add-photo__subtitle">Название</span>
            <span class="form_add-photo__subtitle2">как я провел лето</span>
          </div>
          <div class="form_add-photo__row">
            <div id="dropzone">
              <div class="dropzone__inner-text">
                <span class="dropzone__fa fa fa-camera"></span>
                <span class="dropzone__text">Перетащите фото сюда или</span>
                <label class="link">выберите файл
                  <input type="file" name="cover" class="form__input form__input_file">
                </label>
              </div>
            </div>
          </div>
          <div class="form_add-photo__row">
            <div class="error-notification">Выбран неверный формат изображений. Попробуйте снова</div>
          </div>
          <div class="form_add-photo__row"><span class="form_add-photo__subtitle">Следующие файлы не будут загружены</span><span class="form_add-photo__subtitle2">(размер более 2мб)</span></div>
        </div>
        <div class="hm-modal__footer">
          <button class="btn btn_ok">Сохранить</button>
          <button class="btn btn_link js-close-modal">Отменить</button>
        </div>
      </form>
    </div>
  </div>
</div>