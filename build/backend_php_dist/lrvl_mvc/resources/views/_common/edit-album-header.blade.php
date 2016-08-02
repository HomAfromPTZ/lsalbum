<form id="edit-album-header" class="hform hide" data-id="{{ $album->id }}">
  {{csrf_field()}}
  <div class="header-holder header-holder_edit-album" id="edit_album_header_preview" style="background-image: url({{ $album->cover->img_url }});"
       data-backup="{{ $album->cover->img_url }}">
    <div class="fix-width">
      <div class="change-photo change-photo_cover">
        <div class="change-photo__text">
          <label class="link"> <span class="fa fa-camera"> </span>Изменить фон
            <input type="file" name="cover" class="form__input form__input_file" id="album_new_cover_modal">
          </label>
        </div>
      </div>
      <div class="header-content header-content_edit-album">
        <div class="input-group">
          <input id="" name="title" type="text" class="input_rounded input_header-album"
                 value="{{ $album->title }}"
                 data-backup="{{ $album->title }}">
        </div>
        <div class="input-group">
          <textarea name="description" cols="30" rows="5" class="input_rounded input_header-album"
                    data-backup="{!!preg_replace("/(#(\w{3,}))/", "<a href='/search/?searchtext=$2&hashtag=true'>$1</a>", $album->description)!!}">{!!preg_replace("/(#(\w{3,}))/", "<a href='/search/?searchtext=$2&hashtag=true'>$1</a>", $album->description)!!}</textarea>
        </div>
      </div>
    </div>
  </div>
  <div class="hform__footer">
    <button class="btn btn_ok">Сохранить</button>
    <button class="btn btn_link js-close-header">Отменить</button>
  </div>
</form>