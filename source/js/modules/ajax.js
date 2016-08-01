/** ====================================
* ----- Установка ajax-запросов --------
* =================================== */

var setAjaxResponces = (function() {

  function init() {

    // Редактирование данных пользователя
    $('#edit-user-header').on('submit', function (e) {
      e.preventDefault();
      var formData = new FormData($(e.target)[0]);

      $.ajax({
            method: "POST",
            url: "/user/savedata",
            data: formData,
            processData: false,
            contentType: false
          })
          .done(function (msg) {
            if(msg.status == 'success') {
              if(msg.background !== undefined) {
                $('.header').css({
                  backgroundImage: "url("+msg.background+")"
                });
              }
              if(msg.avatar !== undefined) {
                $('#user-avatar').attr('src', msg.avatar);
              }
              $('.user-info__name').text(formData.get('name'));
              $('.user-info__desc').text(formData.get('description'));
              $('#social__link_vk').attr('href', formData.get('vk'));
              $('#social__link_fb').attr('href', formData.get('facebook'));
              $('#social__link_tw').attr('href', formData.get('twitter'));
              $('#social__link_gg').attr('href', formData.get('google'));
              $('#social__link_email').attr('href', "mailto:"+formData.get('email'));
            }
            $(e.target).removeClass('show').addClass('hide');
            $('body').removeClass('has-overflow-hidden');
          });
    });

    // Добавление альбома
    $('#form-add-album').on('submit', function (e) {
      e.preventDefault();
      var formData = new FormData($(e.target)[0]);
console.log('add-album');
      $.ajax({
        method: "POST",
        url: "/album/save",
        data: formData,
        processData: false,
        contentType: false
      })
      .done(function (msg) {
        console.log(msg);
      })
    })

    // Изменение альбома в header
    $('#edit-album-header').on('submit', function (e) {
      e.preventDefault();
      var formData = new FormData($(e.target)[0]),
          album_id = $(e.target).data('id');

console.log('edit-album with id ='+ album_id);

      $.ajax({
        method: "POST",
        url: "/album/update/"+ album_id,
        data: formData,
        processData: false,
        contentType: false
      })
      .done(function (msg) {
        console.log(msg);

        if(msg.status == 'success') {
          
          $('.header-holder_edit-album').css({
            backgroundImage: "url("+msg.background+")"
          });
          
          $('.my-album-title').text(formData.get('title'));
          $('.my-album-desc').text(formData.get('description'));

          $(e.target).removeClass('show').addClass('hide');
          $('body').removeClass('has-overflow-hidden');
        }

      })
    })

  }
  
  return {
    init: init
  }
}());

module.exports = {
  init: setAjaxResponces.init
};