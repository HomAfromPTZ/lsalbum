<div id="edit-photo-modal" class="hm-modal hide">
  <div class="hm-modal__container">
    <div class="hm-modal__content">
      <div class="hm-modal__header">
        <div class="hm-modal__title">Редактировать фотографию</div>
        <button class="hm-modal__close js-close-modal"><span class="fa fa-close"></span></button>
      </div>
      <form class="form" id="edit-photo-modal">
        {{csrf_field()}}
        <div class="hm-modal__text photo-editing">
          <div class="input-group">
            <label class="label_left">Название</label>
            <input name="title" type="text" class="input_rounded">
          </div>
          <div class="input-group">
            <label class="label_left">Описание</label>
            <textarea name="description" cols="30" rows="10" class="input_rounded"></textarea>
          </div>
        </div>
        <div class="hm-modal__text removing-block is-hidden">
          <div class="removing__p">Вы хотите удалить это фото?</div>
          <button class="btn btn_red ">Удалить</button>
          <button class="btn btn_link js-hide-removing-block">Отменить</button>
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