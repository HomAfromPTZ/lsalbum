/** ===================================================
 * ----- Подключение предпросмотра фото и фона --------
 * ================================================= */

var imagePreview = (function() {

  function init() {

    // Avatar preview
    $('#input_avatar').on('change', function(){
      var input = this,
          avatar = $('#preview_avatar');

      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e){
          avatar.attr("src", e.target.result);
        };

        reader.readAsDataURL(input.files[0]);

      }
    });

    // Background preview
    $('#input_background').on('change', function(){
      var input = this,
          bg = $('#bg-edit-user');

      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e){
          bg.css({
            backgroundImage: "url("+ e.target.result +")"
          });
        };

        reader.readAsDataURL(input.files[0]);

      }
    });
  }

  return {
    init: init
  }
}());

module.exports = {
  init: imagePreview.init
};