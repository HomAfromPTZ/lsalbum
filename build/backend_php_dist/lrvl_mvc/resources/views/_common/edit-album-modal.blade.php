<div id="edit-album-modal" class="hm-modal hide">
  <div class="hm-modal__container">
    <div class="hm-modal__content">
      <div class="hm-modal__header">
        <div class="hm-modal__title">Редактировать альбом</div>
        <button class="hm-modal__close js-close-modal"><span class="fa fa-close"></span></button>
      </div>
      
      <form class="form" id="edit-album-modal__form">
        {{csrf_field()}}
        <div class="hm-modal__text editing-block">
          <div class="input-group">
            <label class="label_left">Название</label>
            <input name="title" type="text" placeholder="Название альбома" class="input_rounded">
          </div>
          <div class="input-group">
            <label class="label_left">Описание</label>
            <textarea name="description" cols="30" rows="10" placeholder="Описание альбома" class="input_rounded"></textarea>
          </div>
          <div class="input-group input-group_upload">
            <div class="image-preview-holder">
              <div class="image-preview">
                <img src="/assets/img/no_photo.jpg" alt="" class="image-preview__pic" id="edit_album_modal_preview">
              </div>
            </div>
            <label class="file-label btn btn_transparent">Поменять обложку
              <input type="file" name="cover" class="form__input form__input_file" id="album_new_cover_modal">
            </label>
            <div class="form__notice">(файл должен быть размером не&nbsp;более 1024&nbsp;КБ)</div>
          </div>
        </div>
        <div class="hm-modal__text removing-block is-hidden">
          <div class="removing__p">Вы хотите удалить этот альбом?</div>
          <button type="button" class="btn btn_red" id="delete-album">Удалить</button>
          <button type="button" class="btn btn_link js-hide-removing-block">Отменить</button>
        </div>
        <div class="hm-modal__footer">
          <button type="submit" class="btn btn_ok">Сохранить</button>
          <button type="button" class="btn btn_link js-close-modal">Отменить</button>
          <button type="button" class="btn btn_red js-show-removing-block"><span class="fa fa-trash"></span><span>Удалить</span></button>
        </div>
      </form>
      
    </div>
  </div>
</div>