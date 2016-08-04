/** ====================================
* ----- Установка ajax-запросов --------
* =================================== */


function init() {

	// -----------------------------------
	// Редактирование данных пользователя
	// -----------------------------------
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
					$('#user-avatar')
					.add('#slider__authuser-avatar')
					.attr('src', msg.avatar);
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
			$('html').removeClass('has-overflow-hidden')
				.css({"padding-right" : 0});
		});
	});



	// -----------------------------
	// Добавление альбома
	// -----------------------------
	$('#form-add-album').on('submit', function (e) {
		e.preventDefault();
		var formData = new FormData($(e.target)[0]);

		// console.log('add-album');

		$.ajax({
			method: "POST",
			url: "/album/save",
			data: formData,
			processData: false,
			contentType: false
		})
		.done(function (album) {
			// console.log(album);
			if(album.status == 'success') {

				var $album_container = $(".album-container"),
					$album = $("<div class='album-item' data-id='"+ album.id +"'>\
						<div class='album-item-holder'>\
						<a href='/album/"+ album.id +"' class='my-album'>\
						<img src='"+ album.cover +"' alt=''/>\
						<div class='album-mask'>\
						<div class='mask-content'>\
						<div class='mask-content__desc'>"+ album.description +"</div>\
						<div class='mask-content__count'><span>1 </span>Фотографий</div>\
						</div></div></a>\
						<div class='album-category'>\
						<a href='#' class='edit-post js-edit-album'>\
						<i class='fa fa-pencil'></i>\
						</a>\
						<span class='category-name'>"+ album.title +"</span></div>\
						</div></div>");

				if( $album_container.eq(1).children('h2') ) {
					$album_container.eq(1).children('h2').remove();
				}

				$album_container.eq(1).prepend($album);

				$("#add-album-modal").removeClass('show').addClass('hide');
				$("#add-album-modal").find("input, textarea").not('input[type=hidden]').each(function () {
					$(this).val('');
				});
				$('#add-album-preview').attr('src', '/assets/img/no_photo.jpg');
				$('html').removeClass('has-overflow-hidden');
			}
		});
	});



	// -----------------------------
	// Изменение альбома в header
	// -----------------------------
	$('#edit-album-header').on('submit', function (e) {
		e.preventDefault();
		var formData = new FormData($(e.target)[0]),
		album_id = $(e.target).data('id');

		// console.log('edit-album with id ='+ album_id);

		$.ajax({
			method: "POST",
			url: "/album/update/"+ album_id,
			data: formData,
			processData: false,
			contentType: false
		})
		.done(function (album) {
			// console.log(album);

			if(album.status == 'success') {
				$('.my-album-title').text(album.title);
				$('.my-album-desc').html( album.description);
				$('.header_album').css({
					backgroundImage: "url("+album.cover+")"
				});

				$(e.target).removeClass('show').addClass('hide');
				$('html').removeClass('has-overflow-hidden');
			}
		});
	});



	// -----------------------------
	// Изменение альбома в модалке
	// -----------------------------
	$('#edit-album-modal__form').on('submit', function (e) {
		e.preventDefault();
		var formData = new FormData($(e.target)[0]),
		album_id = $(e.target).data('id');

		// console.log('edit-album-modal with id ='+ album_id);

		$.ajax({
			method: "POST",
			url: "/album/update/"+ album_id,
			data: formData,
			processData: false,
			contentType: false
		})
		.done(function (album) {
		// console.log(album);
			if(album.status == 'success') {

				var $album_block = $(".album-item[data-id="+ album_id +"]");

				$album_block.find(".category-name").text(album.title);
				$album_block.find(".mask-content__desc").text(album.description);
				$album_block.find(".my-album img").attr("src", album.cover );

				$("#edit-album-modal").removeClass('show').addClass('hide');
				$('html').removeClass('has-overflow-hidden');
			}
		});
	});



	// -----------------------------
	// Удаление альбома в модалке
	// -----------------------------
	$('#delete-album').on('click', function (e) {
		e.preventDefault();
		var album_id = $("#edit-album-modal__form").data('id');
		// console.log(album_id);
		$.ajax({
			method: "GET",
			url: "/album/delete/"+ album_id,
			processData: false,
			contentType: false
		})
		.done(function (album) {

			if(album.status == 'success') {

				var $album_block = $(".album-item[data-id="+ album_id +"]"),
				$album_container = $album_block.parent();

				$album_block.remove();

				if( !$album_container.children(".album-item").length ) {
					$album_container.append("<h2>no albums yet</h2>");
				}

				$("#edit-album-modal").find('.editing-block').show();
				$("#edit-album-modal").find('.hm-modal__footer button').show();
				$("#edit-album-modal").find('.removing-block').hide();

				$("#edit-album-modal").removeClass('show').addClass('hide');
				$("#edit-album-modal").find("input, textarea").not('input[type=hidden]').each(function () {
					$(this).val('');
				});

				$('html').removeClass('has-overflow-hidden');
			}
		});
	});



	// -----------------------------
	// Изменение фото в модалке
	// -----------------------------
	$('#edit-photo-modal').on('submit', function (e) {
		e.preventDefault();
		var formData = new FormData($(e.target)[0]),
			photo_id = $(this).data('id');

		console.log("photo_id = "+photo_id);

		$.ajax({
			method: "POST",
			url: "/photo/update/"+ photo_id,
			data: formData,
			processData: false,
			contentType: false
		})
		.done(function (photo) {
			console.log(photo);
			// if(photo.status == 'success') {

				// var $album_block = $(".album-item[data-id="+ album_id +"]"),
				//     $album_container = $album_block.parent();
				//
				// $album_block.remove();
				//
				// if( !$album_container.children(".album-item").length ) {
				//   $album_container.append("<h2>no albums yet</h2>")
				// }
				//
				// $("#edit-album-modal").find('.editing-block').show();
				// $("#edit-album-modal").find('.hm-modal__footer button').show();
				// $("#edit-album-modal").find('.removing-block').hide();
				//
			// }
			$("#edit-photo-modal").removeClass('show').addClass('hide');

			$('html').removeClass('has-overflow-hidden');
		});
	});



	// -----------------------------
	// Обработка лайков
	// -----------------------------
	$("#js-like-button").click(function(e){
		var like_button = $(this),
			photo_id = like_button.data("photoid"),
			is_liked = like_button.data("liked"),
			like_counter = like_button.find('.likes__count'),
			likes_num = parseInt(like_counter.html());

		if(!is_liked){
			$.ajax({
				url: "/like/" + photo_id,
				type: "GET",
				dataType: "json"
			}).done(function(resp){
				like_counter.html(++likes_num);
				like_button.data('liked', 1);
			}).fail(function(resp){
				alert("Ошибка сервера");
			});
		} else {
			$.ajax({
				url: "/unlike/" + photo_id,
				type: "GET",
				dataType: "json"
			}).done(function(resp){
				like_counter.html(--likes_num);
				like_button.data('liked', 0);
			}).fail(function(resp){
				alert("Ошибка сервера");
			});
		}
	});

	// -----------------------------
	// Следующий обработчик
	// -----------------------------

}


module.exports = {
	init: init
};