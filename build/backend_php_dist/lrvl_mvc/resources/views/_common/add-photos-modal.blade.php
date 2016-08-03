<div id="add-photos-modal" class="hm-modal hide">
  <div class="hm-modal__container">
    <div class="hm-modal__content hm-modal_add-photo__content">
      <div class="hm-modal__header">
        <div class="hm-modal__title">Добавить фотографии</div>
        <button class="hm-modal__close js-close-modal js-clear-dropzone"><span class="fa fa-close"></span></button>
      </div>
      <form class="form form_add-photo" data-id="{{ $album->id }}" action="{{ url('/photo/save/'.$album->id) }}">
        {{csrf_field()}}
        <input type="hidden" id="csrf_token" name="csrf_token" value="{{csrf_token()}}">
        <div class="hm-modal__text hm-modal_add-photo__text">
          <div class="form_add-photo__row">
            <span class="form_add-photo__subtitle">Альбом:</span>
            <span class="form_add-photo__subtitle2">{{$album->title}}</span>
          </div>
          <div class="form_add-photo__row">
            <div id="dropzone" class="mydropzone">
              <div class="fallback">
                <div class="dropzone__inner-text">
                  <span class="dropzone__fa fa fa-camera"></span>
                  <span class="dropzone__text">Перетащите фото сюда или выберите файл</span>
                  <label class="link">выберите файл
                    <input type="file" name="cover" class="form__input form__input_file">
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="form_add-photo__row">
            <div class="error-notification">Выбран неверный формат изображений. Попробуйте снова</div>
          </div>
          <div id="fail-area" class="form_add-photo__row is-hidden"><span class="form_add-photo__subtitle">Следующие файлы не будут загружены</span><span class="form_add-photo__subtitle2">(см. пояснения)</span>
            <div id="fail-dropzone" class="mydropzone dropzone_fail"></div>
          </div>
        </div>
        <div class="hm-modal__footer">
          <button type="button" class="btn btn_ok js-send-dropzone">Сохранить</button>
          <button type="button" class="btn btn_link js-close-modal js-clear-dropzone">Отменить</button>
        </div>
      </form>
    </div>
  </div>
</div>