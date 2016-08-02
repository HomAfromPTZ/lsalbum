/** ===================================================
 * ----- Подключение предпросмотра фото и фона --------
 * ================================================= */

var imagePreview = (function() {

  /** Массив всех элементов для превью изменения изображений
   *
   * Описание:
   * input - input:type=file - поле формы, в которое загружается фото
   * target - элемент, в котором показано предпросмотр фото
   * method - функция, которая изменяет свойства target-элемента
   */

  var collection = [

    // Фото юзера на главной странице
    {
      "input": "#input_avatar",
      "target": "#preview_avatar",
      "method": function(e, target) { $(target).attr("src", e.target.result)  }
    },

    // Фон юзера на главной странице
    {
      "input": "#input_background",
      "target": "#bg-edit-user",
      "method": function(e, target) { $(target).css("background-image", "url("+ e.target.result +")") }
    },
  
   // Фон альбома в хедере
    {
      "input": "#album_new_cover",
      "target": "#edit_album_header_preview",
      "method": function(e, target) { $(target).css("background-image", "url("+ e.target.result +")") }
    },

    // Фон альбома в модалке
    {
      "input": "#album_new_cover_modal",
      "target": "#edit_album_modal_preview",
      "method": function(e, target) { $(target).attr("src", e.target.result) }
    }
  ];


  function init() {

    collection.forEach(function (item) {

      var input = item.input,
          target = item.target,
          method = item.method;

      $(input).on('change', function(){

        if (this.files && this.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
            method(e, target)
          };

          reader.readAsDataURL(this.files[0]);
        }
      });

    });
  }

  return {
    init: init
  }
}());

module.exports = {
  init: imagePreview.init
};