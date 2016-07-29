/** ====================================
* ----- Установка ajax-запросов --------
* =================================== */

var setAjaxResponces = (function() {

  function init() {
    $('#edit-user-header').on('submit', function (e) {
      e.preventDefault();
      var formData = new FormData($(e.target)[0]);

      // console.log(formData);

      $.ajax({
            method: "POST",
            url: "/user/savedata",
            data: formData,
            processData: false,
            contentType: false
          })
          .done(function (msg) {
console.log(msg);

            if(msg.status == 'success') {
              $('.main-page').css({
                backgroundImage: "url("+msg.background+")"
              });
              $('#user-avatar').attr('src', msg.avatar);
              $('.user-info__name').text(formData.get('name'));
              $('.user-info__desc').text(formData.get('description'));
              $('#social__link_vk').attr('href', formData.get('vk'));
              $('#social__link_fb').attr('href', formData.get('facebook'));
              $('#social__link_tw').attr('href', formData.get('twitter'));
              $('#social__link_gg').attr('href', formData.get('google'));
              $('#social__link_email').attr('href', "mailto:"+formData.get('email'));

            }

            $(e.target).removeClass('show').addClass('hide');
          });
    });
// console.log('ajax');

    // form welcome
    // $('#form_welcome').on('submit', function (e) {
    //   e.preventDefault();
    //   var formData = new FormData($(e.target)[0]);
    //
    //   // console.log(formData);
    //
    //   $.ajax({
    //         method: "POST",
    //         url: "/auth/login",
    //         data: formData,
    //         processData: false,
    //         contentType: false,
    //         error: function(data){
    //           console.log('error');
    //           // var errors = data.responseJSON;
    //           // console.log(data);
    //          },
    //       success: function(data){
    //           console.log('success');
    //           // console.log(data);
    //          }
    //
    //       });
    //       // .done(function (msg) {
    //       //   console.log(msg);
    //       // })
    //       // .fail(function(msg) {
    //       //   alert( "error" );
    //       // });
    // });
  }
  
  return {
    init: init
  }
}());

module.exports = {
  init: setAjaxResponces.init
};